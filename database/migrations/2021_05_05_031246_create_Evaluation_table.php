<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Evaluation', function (Blueprint $table) {
            $table->id('id');
            $table->longText('description');
            $table->enum('star',['1','2','3','4','5']);
            $table->enum('status',['pending','approved']);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_fanArt');
            $table->timestamps();
        });
        Schema::table('Evaluation', function (Blueprint $table){
            $table->foreign('id_user')->references('id')->on('User')->onDelete('cascade');
            $table->foreign('id_fanArt')->references('id')->on('FanArt')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Evaluation');
    }
}
