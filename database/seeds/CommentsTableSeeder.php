<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'id' => '1',
            'comment' => '¡Este video es genial! Uno de los mejores de la banda',
            'like' => '10',
            'type' => 'com',
            'id_user' => '1',
            'id_video' => '11',

        ]);

        DB::table('comments')->insert([
            'id' => '2',
            'comment' => 'Me encanta como sorprendieron a las chicas en sus bodas',
            'like' => '12',
            'type' => 'com',
            'id_user' => '2',
            'id_video' => '11',

        ]);

        DB::table('comments')->insert([
            'id' => '3',
            'comment' => '¡También me encanta este video!',
            'like' => '1',
            'type' => 'com',
            'id_user' => '9',
            'id_video' => '11',

        ]);

    }
}
