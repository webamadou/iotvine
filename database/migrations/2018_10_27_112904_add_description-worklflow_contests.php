<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionWorklflowContests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function( Blueprint $table ){
            $table->text('description')->nullable()->default(null);
            $table->integer('workflow')->nullable()->default(null);
            $table->integer('nbr_views')->nullable()->default(null)->after('nbr_contestants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contests', function( Blueprint $table ){
            $table->dropColumn('description');
            $table->dropColumn('workflow');
            $table->dropColumn('nbr_views');
        });

    }
}
