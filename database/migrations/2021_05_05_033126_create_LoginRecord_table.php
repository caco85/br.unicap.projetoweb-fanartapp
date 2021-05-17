<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LoginRecord', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
        });

        Schema::table('LoginRecord', function (Blueprint $table){
            $table->foreign('id_user')->references('id')->on('User')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('LoginRecord');
    }
}
