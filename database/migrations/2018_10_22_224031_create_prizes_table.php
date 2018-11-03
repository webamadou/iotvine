<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prizes', function (Blueprint $table) {
            //id, user_id, name, description, images, status, type[electronic, physic],
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned()->default(null);
            $table->text('description')->default(null) ;
            $table->text('images')->default(null) ;
            $table->integer('type')->default(null)->comment('type of prize: 1=electronic,2=physique') ;
            $table->text('status')->default(null) ;
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->ondelete('no action')->onupdate('no action') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
    }
}
