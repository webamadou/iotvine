<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContestsPrizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('contests_prizes', function (Blueprint $table){
            //id, contest_id, prize_id, quantity, custom_description, custom_image, status
            $table->increments('id', true);
            $table->integer('contest_id')->unsigned();
            $table->integer('prize_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->text('custom_description')->default(null);
            $table->text('custom_image')->default(null);
            $table->integer('status')->unsigned();
            $table->timestamps();
            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onUpdate('cascade')
                ->onDelete('no action');
            $table->foreign('prize_id')
                ->references('id')
                ->on('prizes')
                ->onUpdate('cascade')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('contests_prizes');
    }
}
