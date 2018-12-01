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
            $table->integer('contest_entry_id')->nullable(true)->unsigned();
            $table->string('ip_address')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('winner')->nullable(true)->comment('If 1=winner');
            $table->integer('ranking')->nullable(true);
            $table->integer('status')->default(1)->nullable();
            $table->timestamps();
        });
        Schema::table('contestants', function (Blueprint $table){
            $table->foreign('contest_entry_id', 'contests_entrie_contest_fk')
                  ->references('id')
                  ->on('contest_entry')
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
            $table->dropColumn('contest_entry_id');
        });
        Schema::dropIfExists('contestants');
    }
}
