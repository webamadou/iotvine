<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrizeCurrency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prizes', function (Blueprint $table){
            $table->integer('currency_id')->unsigned();
            $table->foreign('currency_id', 'currency_id_prizes_fk')->references('id')->on('currencies')->onDelete('no action')->onUpdate('no action');
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
            $table->dropForeign('currency_id_prizes_fk');
            $table->dropColumn('currency_id');
        });
    }
}
