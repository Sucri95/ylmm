<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'email' => 'susana@trenders.com.ar',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Susana',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '4',
            'id_wall' => '1',
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'email' => 'pedro@trenders.com.ar',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Pedro',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '4',
            'id_wall' => '2',
        ]);

        DB::table('users')->insert([
            'id' => '3',
            'email' => 'integrante1@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Adam Levine',
            'profile_pic' =>  '../../images/adam.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '1',
            'id_musician' => '1',
            'id_wall' => '3',
        ]);

        DB::table('users')->insert([
            'id' => '4',
            'email' => 'integrante2@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Mickey Madden',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '1',
            'id_musician' => '2',
            'id_wall' => '4',
        ]);

        DB::table('users')->insert([
            'id' => '5',
            'email' => 'integrante3@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'James Valentine',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '1',
            'id_musician' => '3',
            'id_wall' => '5',
        ]);

        DB::table('users')->insert([
            'id' => '6',
            'email' => 'integrante4@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Matt Flynn',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '1',
            'id_musician' => '4',
            'id_wall' => '6',
        ]);

        DB::table('users')->insert([
            'id' => '7',
            'email' => 'integrante5@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Jesse Carmichael',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '1',
            'id_musician' => '5',
            'id_wall' => '7',
        ]);

        DB::table('users')->insert([
            'id' => '8',
            'email' => 'integrante6@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'P. J. Morton',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '1',
            'id_musician' => '6',
            'id_wall' => '8',
        ]);

        DB::table('users')->insert([
            'id' => '9',
            'email' => 'prueba2@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Melisa Sánchez',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '4',
            'id_wall' => '9',
        ]);

        DB::table('users')->insert([
            'id' => '10',
            'email' => 'integrante7@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Olly Alexander',
            'profile_pic' =>  '../../images/olly.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '2',
            'id_musician' => '7',
            'id_wall' => '10',
        ]);

        DB::table('users')->insert([
            'id' => '11',
            'email' => 'integrante8@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Mikey Goldsworthy',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '2',
            'id_musician' => '8',
            'id_wall' => '11',
        ]);

        DB::table('users')->insert([
            'id' => '12',
            'email' => 'integrante9@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Emre Türkmen',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '2',
            'id_musician' => '9',
            'id_wall' => '12',
        ]);

        DB::table('users')->insert([
            'id' => '13',
            'email' => 'integrante10@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Ed Sheeran',
            'profile_pic' =>  '../../images/edsheeran.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '3',
            'id_musician' => '10',
            'id_wall' => '13',
        ]);

        DB::table('users')->insert([
            'id' => '14',
            'email' => 'integrante12@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Bruno Mars',
            'profile_pic' =>  '../../images/brunomars.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '4',
            'id_musician' => '11',
            'id_wall' => '14',
        ]);

        DB::table('users')->insert([
            'id' => '15',
            'email' => 'integrante13@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Katy Perry',
            'profile_pic' =>  '../../images/katyperry.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '5',
            'id_musician' => '12',
            'id_wall' => '15',
        ]);

        DB::table('users')->insert([
            'id' => '16',
            'email' => 'integrante14@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Nasri Atweh',
            'profile_pic' =>  '../../images/nasri.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '6',
            'id_musician' => '13',
            'id_wall' => '16',
        ]);

        DB::table('users')->insert([
            'id' => '17',
            'email' => 'integrante15@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Mark Pellizzer',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '6',
            'id_musician' => '14',
            'id_wall' => '17',
        ]);

        DB::table('users')->insert([
            'id' => '18',
            'email' => 'integrante16@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Ben Spivak',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '6',
            'id_musician' => '15',
            'id_wall' => '18',
        ]);

        DB::table('users')->insert([
            'id' => '19',
            'email' => 'integrante17@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Alex Tanas',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '6',
            'id_musician' => '16',
            'id_wall' => '19',
        ]);

        DB::table('users')->insert([
            'id' => '20',
            'email' => 'integrante18@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Shawn Mendes',
            'profile_pic' =>  '../../images/shawn.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '7',
            'id_musician' => '17',
            'id_wall' => '20',
        ]);

        DB::table('users')->insert([
            'id' => '21',
            'email' => 'integrante19@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Dan Reynolds',
            'profile_pic' =>  '../../images/dan.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '8',
            'id_musician' => '18',
            'id_wall' => '21',
        ]);

        DB::table('users')->insert([
            'id' => '22',
            'email' => 'integrante20@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Ben McKee',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '8',
            'id_musician' => '19',
            'id_wall' => '22',
        ]);

        DB::table('users')->insert([
            'id' => '23',
            'email' => 'integrante21@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Daniel Wayne Sermon',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '8',
            'id_musician' => '20',
            'id_wall' => '23',
        ]);

        DB::table('users')->insert([
            'id' => '24',
            'email' => 'integrante22@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Daniel Platzman',
            'profile_pic' =>  '../../images/avatar.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '8',
            'id_musician' => '21',
            'id_wall' => '24',
        ]);

        DB::table('users')->insert([
            'id' => '25',
            'email' => 'integrante23@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'John Legend',
            'profile_pic' =>  '../../images/johnlegend.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '9',
            'id_musician' => '22',
            'id_wall' => '25',
        ]);

        DB::table('users')->insert([
            'id' => '26',
            'email' => 'integrante24@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'James Hetfield',
            'profile_pic' =>  '../../images/jameshetfield.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '10',
            'id_musician' => '23',
            'id_wall' => '26',
        ]);

        DB::table('users')->insert([
            'id' => '27',
            'email' => 'integrante25@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Kirk Hammett',
            'profile_pic' =>  '../../images/kirkhammett.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '10',
            'id_musician' => '24',
            'id_wall' => '27',
        ]);

        DB::table('users')->insert([
            'id' => '28',
            'email' => 'integrante26@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Robert Trujillo',
            'profile_pic' =>  '../../images/roberttrujillo.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '10',
            'id_musician' => '25',
            'id_wall' => '28',
        ]);

        DB::table('users')->insert([
            'id' => '29',
            'email' => 'integrante27@gmail.com',
            'password' => '$2y$10$kJfDmvZp285WRiFzttG3/uoYIHb00fMyEl8lFc/41.aOWLVSSm/ze',
            'name' => 'Lars Ulrich',
            'profile_pic' =>  '../../images/larsulrich.jpg', 
            'province' => 'CABA',
            'status' => 'A',
            'verified' => '1',
            'user_level' => '3',
            'id_band' => '10',
            'id_musician' => '26',
            'id_wall' => '29',
        ]);

    }
}
