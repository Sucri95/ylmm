<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('genres')->insert([
            'id' => '1',
            'name' => 'ROCK',
            'image' => '../../images/rock.jpg',
            'color' => 'genres-rock',
        ]);
        DB::table('genres')->insert([
            'id' => '2',
            'name' => 'POP',
            'image' => '../../images/pop.jpg',
            'color' => 'genres-pop',
        ]);
        DB::table('genres')->insert([
            'id' => '3',
            'name' => 'ELECTRONICA',
            'image' => '../../images/electronic.jpg',
            'color' => 'genres-electronica',
        ]);
        DB::table('genres')->insert([
            'id' => '4',
            'name' => 'FOLCLORE',
            'image' => '../../images/folk.jpg',
            'color' => 'genres-folk',
        ]);
        DB::table('genres')->insert([
            'id' => '5',
            'name' => 'HIP HOP',
            'image' => '../../images/hiphop.jpg',
            'color' => 'genres-hiphop',
        ]);
        DB::table('genres')->insert([
            'id' => '6',
            'name' => 'JAZZ',
            'image' => '../../images/jazz.jpg',
            'color' => 'genres-jazz',
        ]);
        DB::table('genres')->insert([
            'id' => '7',
            'name' => 'TANGO',
            'image' => '../../images/tango.jpg',
            'color' => 'genres-tango',
        ]);
        DB::table('genres')->insert([
            'id' => '8',
            'name' => 'REGGAE',
            'image' => '../../images/reggae.jpg',
            'color' => 'genres-reggae',
        ]);
        DB::table('genres')->insert([
            'id' => '9',
            'name' => 'URBANA',
            'image' => '../../images/urban.jpg',
            'color' => 'genres-urbana',
        ]);
        DB::table('genres')->insert([
            'id' => '10',
            'name' => 'HEAVY METAL',
            'image' => '../../images/heavymetal.jpg',
            'color' => 'genres-heavymetal',
        ]);

        DB::table('genres')->insert([
            'id' => '11',
            'name' => 'CUMBIA',
            'image' => '../../images/cumbia.jpg',
            'color' => 'genres-cumbia',
        ]);

    }
}
