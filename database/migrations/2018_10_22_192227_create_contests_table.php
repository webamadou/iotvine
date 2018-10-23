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
            $table->string('language')->default('');
            $table->integer('private')->default(null);
            $table->dateTime('start')->default(null);
            $table->dateTime('end')->default(null);
            $table->string('email_prize')->comment('do we send email to the winner by email')->default(null);
            $table->integer('display_winner')->default(null)->unsigned('display winner at end of contest');
            $table->integer('pick')->default(null)->comment('the way the winner is picked: random=0,manually=1,automatique=2(most points) ');
            $table->text('prize_claim_note')->default(null)->comment('The note for the email to claim the prize');
            $table->text('url')->default(null)->comment('the url of the contest for integration purpose');
            $table->text('nbr_contestants')->default(null);
            $table->string('images')->default(null);
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
