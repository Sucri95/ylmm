<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'id' => '1',
            'role' => 'a:2:{i:0;s:3:"VOZ";i:1;s:8:"GUITARRA";}',
            'id_band' => '1',
            'id_user' => '3',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '2',
            'role' => 'a:1:{i:0;s:4:"BAJO";}',
            'id_band' => '1',
            'id_user' => '4',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '3',
            'role' => 'a:1:{i:0;s:8:"GUITARRA";}',
            'id_band' => '1',
            'id_user' => '5',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '4',
            'role' => 'a:1:{i:0;s:8:"BATERÍA";}',
            'id_band' => '1',
            'id_user' => '6',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '5',
            'role' => 'a:2:{i:0;s:8:"TECLADOS";i:1;s:8:"GUITARRA";}',
            'id_band' => '1',
            'id_user' => '7',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '6',
            'role' => 'a:1:{i:0;s:8:"TECLADOS";}',
            'id_band' => '1',
            'id_user' => '8',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '7',
            'role' => 'a:3:{i:0;s:3:"VOZ";i:1;s:8:"TECLADOS";i:2;s:8:"GUITARRA";}',
            'id_band' => '2',
            'id_user' => '10',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '8',
            'role' => 'a:1:{i:0;s:4:"BAJO";}',
            'id_band' => '2',
            'id_user' => '11',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '9',
            'role' => 'a:2:{i:1;s:17:"PRODUCTOR MUSICAL";i:2;s:12:"SINTETIZADOR";}',
            'id_band' => '2',
            'id_user' => '12',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '10',
            'role' => 'a:2:{i:0;s:3:"VOZ";i:1;s:8:"GUITARRA";}',
            'id_band' => '3',
            'id_user' => '13',
            'verified' => 'Y',
        ]);

         DB::table('members')->insert([
            'id' => '11',
            'role' => 'a:7:{i:0;s:3:"VOZ";i:1;s:5:"PIANO";i:2;s:8:"TECLADOS";i:3;s:8:"GUITARRA";i:4;s:4:"BAJO";i:5;s:8:"BATERÍA";i:7;s:8:"trombón";}',
            'id_band' => '4',
            'id_user' => '14',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '12',
            'role' => 'a:3:{i:0;s:3:"VOZ";i:1;s:5:"PIANO";i:2;s:8:"GUITARRA";}',
            'id_band' => '5',
            'id_user' => '15',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '13',
            'role' => 'a:1:{i:0;s:3:"VOZ";}',
            'id_band' => '6',
            'id_user' => '16',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '14',
            'role' => 'a:1:{i:0;s:8:"GUITARRA";}',
            'id_band' => '6',
            'id_user' => '17',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '15',
            'role' => 'a:1:{i:0;s:4:"BAJO";}',
            'id_band' => '6',
            'id_user' => '18',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '16',
            'role' => 'a:1:{i:0;s:8:"BATERÍA";}',
            'id_band' => '6',
            'id_user' => '19',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '17',
            'role' => 'a:2:{i:0;s:3:"VOZ";i:1;s:8:"GUITARRA";}',
            'id_band' => '7',
            'id_user' => '20',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '18',
            'role' => 'a:7:{i:0;s:3:"VOZ";i:1;s:5:"PIANO";i:2;s:8:"TECLADOS";i:3;s:8:"GUITARRA";i:4;s:8:"BATERÍA";i:5;s:10:"PERCUSIÓN";i:7;s:6:"LÍDER";}',
            'id_band' => '8',
            'id_user' => '21',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '19',
            'role' => 'a:6:{i:0;s:4:"CORO";i:1;s:5:"PIANO";i:2;s:8:"TECLADOS";i:3;s:4:"BAJO";i:4;s:8:"BATERÍA";i:5;s:10:"PERCUSIÓN";}',
            'id_band' => '8',
            'id_user' => '22',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '20',
            'role' => 'a:5:{i:0;s:4:"CORO";i:1;s:8:"GUITARRA";i:2;s:8:"BATERÍA";i:3;s:10:"PERCUSIÓN";i:5;s:9:"MANDOLINA";}',
            'id_band' => '8',
            'id_user' => '23',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '21',
            'role' => 'a:6:{i:0;s:4:"CORO";i:1;s:8:"TECLADOS";i:2;s:8:"GUITARRA";i:3;s:8:"BATERÍA";i:4;s:10:"PERCUSIÓN";i:6;s:7:"VIOLÍN";}',
            'id_band' => '8',
            'id_user' => '24',
            'verified' => 'Y',
        ]);

        DB::table('members')->insert([
            'id' => '22',
            'role' => 'a:3:{i:0;s:3:"VOZ";i:1;s:5:"PIANO";i:2;s:8:"GUITARRA";}',
            'id_band' => '9',
            'id_user' => '25',
            'verified' => 'Y',
        ]);
        DB::table('members')->insert([
            'id' => '23',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:3:"VOZ";i:2;s:16:"GUITARRA RITMICA";}',
            'id_band' => '10',
            'id_user' => '26',
            'verified' => 'Y',
        ]);
        DB::table('members')->insert([
            'id' => '24',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:4:"CORO";i:2;s:14:"GUITARRA LIDER";}',
            'id_band' => '10',
            'id_user' => '27',
            'verified' => 'Y',
        ]);
        DB::table('members')->insert([
            'id' => '25',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:4:"CORO";i:2;s:14:"BAJO ELECTRICO";}',
            'id_band' => '10',
            'id_user' => '28',
            'verified' => 'Y',
        ]);
        DB::table('members')->insert([
            'id' => '26',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:8:"BATERÍA";i:2;s:10:"PERCUSIÓN";}',
            'id_band' => '10',
            'id_user' => '29',
            'verified' => 'Y',
        ]);
    }
}
