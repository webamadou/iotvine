<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrefixEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('entries', function (Blueprint $table){
            $table->string('entry_prefix')->nullable(true)->after('description')->comment("This is the prefix link to add to given entry. i.g. http://facebook.com/pageid");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('entries', function (Blueprint $table){
            $table->dropColumn('entry_prefix');
        });
    }
}
