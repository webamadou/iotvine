<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prizes')->delete();
        factory(App\Prize::class, 30)->create();
    }
}
