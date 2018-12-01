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
            $table->string('countries')->nullable(true);
            $table->string('language')->default('')->nullable();
            $table->integer('private')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('email_prize')->comment('do we send email to the winner by email')->nullable();
            $table->integer('display_winner')->unsigned('display winner at end of contest')->nullable();
            $table->integer('pick')->comment('the way the winner is picked: random=0,manually=1,automatique=2(most points) ')->nullable();
            $table->text('prize_claim_note')->comment('The note for the email to claim the prize')->nullable();
            $table->string('url')->comment('the url of the contest for integration purpose')->nullable();
            $table->text('nbr_contestants')->nullable();
            $table->string('images')->nullable();
            $table->integer('status')->nullable()->default(1);
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
