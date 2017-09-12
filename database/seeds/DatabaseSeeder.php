<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(SponsorsTableSeeder::class);
        $this->call(BandsTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(Pv_bandvideoTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(BattlesTableSeeder::class);
        $this->call(MusiciansTableSeeder::class);
    }
}
