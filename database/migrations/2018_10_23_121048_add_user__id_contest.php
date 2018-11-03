<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdContest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table){
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id', 'user_id_contests_fk')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contests', function (Blueprint $table){
            $table->dropForeign('user_id_contests_fk');
            $table->dropColumn('user_id');
        });
    }
}
