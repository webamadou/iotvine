<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('entries')->delete();
        $entries = [
            [
                'name'          => 'Facebook Like',
                'description'   => 'Facebook Like',
                'code'          => '',
                'network_id'    => 1,
                'icon'          => '',
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'name'          => 'Twitter Follow',
                'description'   => 'Twitter Follow',
                'code'          => '',
                'network_id'    => 2,
                'icon'          => '',
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'name'          => 'Instagram Follow',
                'description'   => 'Instagram Follow',
                'code'          => '',
                'network_id'    => 3,
                'icon'          => '',
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('entries')->insert($entries) ;
    }
}
