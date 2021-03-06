<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrizeIdContest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table){
            $table->integer('prize_id')->unsigned()->nullable() ;
            $table->foreign('prize_id', 'prize_id_contests_fk')->references('id')->on('prizes')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contests', function (Blueprint $table){
            $table->dropForeign('prize_id_contests_fk');
            $table->dropColumn('prize_id');
        });
    }
}
