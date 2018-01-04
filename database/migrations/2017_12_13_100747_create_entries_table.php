<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('word_id');
            $table->unsignedTinyInteger('type')->comment('1: nouns, 2: verb, 3: adjective ...etc.');
            $table->boolean('has_sense');
            $table->string('voice_uk_1')->nullable();
            $table->string('voice_us_1')->nullable();
            $table->string('voice_uk_2')->nullable();
            $table->string('voice_us_2')->nullable();
            $table->string('ipa_uk_1')->nullable();
            $table->string('ipa_us_1')->nullable();
            $table->string('ipa_uk_2')->nullable();
            $table->string('ipa_us_2')->nullable();
            $table->string('image')->nullable();
            $table->string('wikipedia')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
