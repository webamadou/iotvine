<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoutriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->char('iso', 4)->nullable(true);
            $table->string('libelle', 100)->nullable(true);
            $table->string('nicename', 80)->nullable(true);
            $table->char('iso3', 3)->nullable(true);
            $table->smallInteger('numcode')->nullable(true);
            $table->integer('phonecode')->nullable(true);
            $table->integer('etat')->nullable(true);
            $table->nullableTimestamps();
        });

        Schema::table('users', function (Blueprint $table){
            $table->integer('country_id')->unsigned()->index()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('country_id');
        });
    }
}
