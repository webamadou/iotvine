<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            //id, name, description, code,social_network_id, icon, status
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable(true);
            $table->string('code')->nullable(true);
            $table->integer('network_id')->unsigned();
            $table->string('icon')->nullable(true);
            $table->integer('status')->nullable(true);
            $table->timestamps();
            $table->foreign('network_id')->references('id')->on('networks')->ondelete('cascade')->onupdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
