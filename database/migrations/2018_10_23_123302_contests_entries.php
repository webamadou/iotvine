<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContestsEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests_entries', function (Blueprint $table){
            // id, contest_id, entry_id, entry_link, configs={entity: value}
            $table->increments('id', true);
            $table->integer('contest_id')->unsigned()->default(null);
            $table->integer('entry_id')->unsigned()->default(null);
            $table->string('entry_link')->default(null)->comment('This can be either the facebook or the twitter page ... depends on the type of entry');
            $table->string('configs')->default(null)->comment('contents a hash that represents the configs on the corresponding entry');
            $table->timestamps();

            $table->foreign('contest_id', 'contest_id_fks')->references('id')->on('contests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('entry_id', 'entry_id_fks')->references('id')->on('entries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contests_entries');
    }
}
