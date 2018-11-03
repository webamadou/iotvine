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
            $table->text('description')->default(null);
            $table->string('code')->default(null);
            $table->integer('network_id')->unsigned();
            $table->string('icon')->default(null);
            $table->integer('status')->default(null);
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
