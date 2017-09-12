<?php

use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sponsors')->insert([
            'id' => '1',
            'name' => 'Unilever',
            'image' => '/images/logo-unilever.png',
            'url' => 'https://www.unilever.com.ar/',
        ]);
        DB::table('sponsors')->insert([
            'id' => '2',
            'name' => 'CocaCola',
            'image' => '/images/logo-cocacola.png',
            'url' => 'https://www.coca-cola.com.ar/es/home/',
        ]);
        DB::table('sponsors')->insert([
            'id' => '3',
            'name' => 'Quilmes',
            'image' => '/images/logo-quilmes.png',
            'url' => 'http://www.quilmes.com.ar/',
        ]);
        DB::table('sponsors')->insert([
            'id' => '4',
            'name' => 'Google',
            'image' => '/images/logo-google.png',
            'url' => 'https://www.google.com.ar/',
        ]);
        DB::table('sponsors')->insert([
            'id' => '5',
            'name' => 'Fender',
            'image' => '/images/logo-fender.png',
            'url' => 'https://www.fender.com/',
        ]);
    }
}
