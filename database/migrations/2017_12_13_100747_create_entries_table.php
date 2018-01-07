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
            $table->unsignedTinyInteger('type')->default(0);
            $table->string('voice_uk_1')->default('');
            $table->string('voice_us_1')->default('');
            $table->string('voice_uk_2')->default('');
            $table->string('voice_us_2')->default('');
            $table->string('ipa_uk_1')->default('');
            $table->string('ipa_us_1')->default('');
            $table->string('ipa_uk_2')->default('');
            $table->string('ipa_us_2')->default('');
            $table->string('image')->default('');
            $table->string('wikipedia')->default('');
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
