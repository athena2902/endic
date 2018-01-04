<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesaurusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesauruses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_entry_id');
            $table->integer('from_sense_id')->nullable();
            $table->integer('to_entry_id');
            $table->integer('to_sense_id')->nullable();
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
        Schema::dropIfExists('thesauruses');
    }
}
