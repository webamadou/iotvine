<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContestSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contests')->delete();
        Factory(App\Contest::class, 30)->create();
    }
}
