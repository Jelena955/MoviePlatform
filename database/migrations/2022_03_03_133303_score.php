<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Scores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->string("tag");
            $table->foreign('tag')->references('tag')->on('tags');
            $table->unsignedBigInteger('movie_id');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->decimal ('relevance', 20,19);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
