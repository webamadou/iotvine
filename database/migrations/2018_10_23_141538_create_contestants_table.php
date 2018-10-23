<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contestants', function (Blueprint $table) {
            //id, constest_entry_id,id_adress,email,status,winner,ranking
            $table->increments('id');
            $table->integer('contests_entrie_id')->default(null)->unsigned();
            $table->string('ip_address')->default(null);
            $table->string('email')->default(null);
            $table->string('winner')->default(null)->comment('If 1=winner');
            $table->integer('ranking')->default(null);
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        Schema::table('contestants', function (Blueprint $table){
            $table->foreign('contests_entrie_id', 'contests_entrie_contest_fk')
                  ->references('id')
                  ->on('contests_entries')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contestants', function (Blueprint $table){
            $table->dropForeign('contests_entrie_contest_fk');
            $table->dropColumn('contests_entrie_id');
        });
        Schema::dropIfExists('contestants');
    }
}
