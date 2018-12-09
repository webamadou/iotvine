<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrizevaluePrizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prizes',function(Blueprint $table){
            $table->integer('prize_value')->unsigned()->nullable(true)->comment('This is a vaue of the prize');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prizes', function (Blueprint $table){
            $table->dropColumn('prize_value');
        });
    }
}
