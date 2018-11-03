<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('countries')->default(null);
            $table->string('language')->default('')->nullable();
            $table->integer('private')->default(null)->nullable();
            $table->dateTime('start')->default(null)->nullable();
            $table->dateTime('end')->default(null)->nullable();
            $table->string('email_prize')->comment('do we send email to the winner by email')->default(null)->nullable();
            $table->integer('display_winner')->default(null)->unsigned('display winner at end of contest')->nullable();
            $table->integer('pick')->default(null)->comment('the way the winner is picked: random=0,manually=1,automatique=2(most points) ')->nullable();
            $table->text('prize_claim_note')->default(null)->comment('The note for the email to claim the prize')->nullable();
            $table->string('url')->default(null)->comment('the url of the contest for integration purpose')->nullable();
            $table->text('nbr_contestants')->default(null)->nullable();
            $table->string('images')->default(null)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contests');
    }
}
