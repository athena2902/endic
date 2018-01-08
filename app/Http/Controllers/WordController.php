<?php

namespace App\Http\Controllers;

use App\Repositories\DefinitionExamples;
use App\Repositories\Definitions;
use App\Repositories\Entries;
use App\Repositories\Examples;
use App\Repositories\Senses;
use Illuminate\Http\Request;
use App\Repositories\Words;
use App\Repositories\WordClasses;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Support\Facades\Log;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Words $words)
    {
        for ($i = 1; $i < 10; $i++) {
            try {
                $word = $words->getById($i);
                Log::info($word->word);
                $this->retrieveData($word->word);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                Log::error('ID:' . $i);
            }
        }
    }


    private function retrieveData($word)
    {
        $classes = new WordClasses();
        $entries = new Entries();
        $senses = new Senses();
        $definitions = new Definitions();
        $definitionExamples = new DefinitionExamples();
        $examples = new Examples();

        $baseUrl = "https://dictionary.cambridge.org/dictionary/english/";
        $url = $baseUrl . $word;
        $content = getDataUrl($url);
        $classes = $classes->getAllValue();
        if ($content) {
            $html = HtmlDomParser::str_get_html($content);
            $tabPanels = $html->find('.tabs__content[role=tabpanel]');
            if (!empty($tabPanels)) {
                $tabEnglish = $tabPanels[0];
                $posHeaders = $tabEnglish->find('.pos-header');
                foreach ($posHeaders as $posHeader) {
                    $posClass = $posHeader->find('.pos')[0];
                    $wordClass = trim($posClass->plaintext);
                    $type = 0;
                    if (in_array($wordClass, $classes)) {
                        $type = array_search($wordClass, $classes) + 1;
                    }
                    $prons = $posHeader->find('.pron-info');
                    $pronUK = $prons[0];
                    $pronUS = $prons[1];
                    $voiceUK1 = $pronUK->children(0)->children(1)->getAttribute('data-src-mp3');
                    $voiceUK2 = $pronUK->children(0)->children(1)->getAttribute('data-src-ogg');
                    $ipaUK1 = $pronUK->children(1)->children(0)->children(0)->plaintext;
                    $voiceUS1 = $pronUS->children(0)->children(1)->getAttribute('data-src-mp3');
                    $voiceUS2 = $pronUS->children(0)->children(1)->getAttribute('data-src-ogg');
                    $ipaUS1 = $pronUS->children(1)->children(0)->children(0)->plaintext;

                    $entryData = [
                        'word_id' => 1,
                        'type' => $type,
                        'voice_uk_1' => $voiceUK1,
                        'voice_uk_2' => $voiceUK2,
                        'voice_us_1' => $voiceUS1,
                        'voice_us_2' => $voiceUS2,
                        'ipa_uk_1' => $ipaUK1,
                        'ipa_us_1' => $ipaUS1,
                    ];

                    $entry = $entries->create($entryData);

                    // retrieve definitions
                    $posBody = $posHeader->next_sibling();
                    $senseBlocks = $posBody->find('.sense-block');
                    foreach ($senseBlocks as $senseBlock) {
                        $guideword = $senseBlock->find('.guideword');
                        $senTitle = '';
                        if ($guideword) {
                            $senTitle = $guideword[0]->children(0)->plaintext;
                            $senTitle = strtolower(trim($senTitle));
                        }
                        $senseData = [
                            'entry_id' => $entry->id,
                            'name' => $senTitle
                        ];
                        $sense = $senses->create($senseData);
                        $defBlocks = $senseBlock->find('.def-block');
                        foreach ($defBlocks as $defBlock) {
                            $def = $defBlock->find('.def')[0]->plaintext;
                            $def = trim($def);
                            $defData = [
                                'sense_id' => $sense->id,
                                'definition' => $def
                            ];
                            $definition = $definitions->create($defData);
                            $exams = $defBlock->find('.examp');
                            foreach ($exams as $exam) {
                                $sentence = trim($exam->plaintext);
                                $examData = [
                                    'definition_id' => $definition->id,
                                    'sentence' => $sentence
                                ];
                                $definitionExamples->create($examData);
                            }
                        }

                        $examplesBlocks = $senseBlock->find('.extraexamps');
                        foreach ($examplesBlocks as $examplesBlock) {
                            $listExample = $examplesBlock->find('li');
                            foreach ($listExample as $li) {
                                $sentence = trim($li->plaintext);
                                $exampleData = [
                                    'sense_id' => $sense->id,
                                    'sentence' => $sentence
                                ];
                                $examples->create($exampleData);
                            }
                        }
                    }
                }
            }
        }
    }
}
