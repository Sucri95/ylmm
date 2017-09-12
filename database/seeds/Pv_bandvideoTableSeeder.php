<?php

use Illuminate\Database\Seeder;

class Pv_bandvideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Pv_bandvideo')->insert([
            'id' => '1',
            'id_video' => '2',
            'id_band' => '1',

        ]);

        DB::table('Pv_bandvideo')->insert([
            'id' => '2',
            'id_video' => '3',
            'id_band' => '1',

        ]);

        DB::table('Pv_bandvideo')->insert([
            'id' => '3',
            'id_video' => '10',
            'id_band' => '1',

        ]);

        DB::table('Pv_bandvideo')->insert([
            'id' => '4',
            'id_video' => '11',
            'id_band' => '1',

        ]);

        DB::table('Pv_bandvideo')->insert([
            'id' => '5',
            'id_video' => '12',
            'id_band' => '1',

        ]);

        DB::table('Pv_bandvideo')->insert([
            'id' => '6',
            'id_video' => '13',
            'id_band' => '1',

        ]);
    }
}
