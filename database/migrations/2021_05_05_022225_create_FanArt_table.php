<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFanArtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FanArt', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->double('mediaRating')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_category');
            $table->timestamps();
        });
        Schema::table('FanArt', function (Blueprint $table){
            $table->foreign('id_user')->references('id')->on('User')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('Category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FanArt');
    }
}
