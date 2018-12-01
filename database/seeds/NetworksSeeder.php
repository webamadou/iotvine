<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('networks')->delete();
        $networks = [
            [
                'name'          => 'facebook',
                'description'   => 'the facebok network',
                'icon'          => 'facebook',
                'status'        => 1,
                'color'         => '#4267b2',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')],
            [
                'name'          => 'twitter',
                'description'   => 'the twitter network',
                'icon'          => 'twitter',
                'status'        => 1,
                'color'         => '#38A1F3',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'name'          => 'instagram',
                'description'   => 'the instagram network',
                'icon'          => 'instagram',
                'status'        =>  1,
                'color'         => '#231F20',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')],
        ];
        DB::table('networks')->insert($networks) ;
    }
}
