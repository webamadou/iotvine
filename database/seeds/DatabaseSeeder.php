<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['prizes','countries','currencies','networks'];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(CountriesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(NetworksSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PrizesTableSeeder::class);
        $this->call(ContestSeederTable::class);
    }
}
