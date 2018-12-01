<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPointPerEntrieContestsEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('contest_entry', function(Blueprint $table) {
            $table->integer('point_per_entry')->nullable()->default(1)->after('entry_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('contest_entry', function (Blueprint $table){
            $table->dropColumn('point_per_entry');
        });
    }
}
