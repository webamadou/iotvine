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
            $table->char('iso', 4)->nullable()->default(null);
            $table->string('libelle', 100)->nullable()->default(null);
            $table->string('nicename', 80)->nullable()->default(null);
            $table->char('iso3', 3)->nullable()->default(null);
            $table->smallInteger('numcode')->nullable()->default(null);
            $table->integer('phonecode')->nullable()->default(null);
            $table->integer('etat')->nullable()->default(null);
            $table->nullableTimestamps();
        });

        Schema::table('users', function (Blueprint $table){
            $table->integer('country_id')->unsigned()->index();
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
