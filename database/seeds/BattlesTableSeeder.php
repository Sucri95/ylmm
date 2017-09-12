<?php

use Illuminate\Database\Seeder;

class BattlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('battles')->insert([
            'id' => '1',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '100',
            'llave' => '2',
            'date_added' => '06/02/2017',
            'name_video' => 'Shine - Years & Years',
            'url' => 'https://www.youtube.com/watch?v=hXTAn4ELEwM',
            'views' => '0',
            'id_band' => '2',
            'id_video' => '1',

        ]);

        DB::table('battles')->insert([
            'id' => '2',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '99',
            'llave' => '2',
            'date_added' => '06/02/2017',
            'name_video' => 'Unkiss Me - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=ZK7hdWwIEkI',
            'views' => '0',
            'id_band' => '1',
            'id_video' => '2',

        ]);

        DB::table('battles')->insert([
            'id' => '3',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Lost Stars - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=cL4uhaQ58Rk',
            'views' => '0',
            'id_band' => '1',
            'id_video' => '3',

        ]);

        DB::table('battles')->insert([
            'id' => '4',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '95',
            'llave' => '2',
            'date_added' => '06/02/2017',
            'name_video' => 'Rude - MAGIC!',
            'url' => 'https://www.youtube.com/watch?v=PIh2xe4jnpk',
            'views' => '0',
            'id_band' => '6',
            'id_video' => '4',

        ]);

        DB::table('battles')->insert([
            'id' => '5',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '90',
            'llave' => '2',
            'date_added' => '06/02/2017',
            'name_video' => 'Uptown Funk - Bruno Mars',
            'url' => 'https://www.youtube.com/watch?v=OPf0YbXqDm0',
            'views' => '0',
            'id_band' => '4',
            'id_video' => '5',

        ]);

        DB::table('battles')->insert([
            'id' => '6',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '70',
            'llave' => '2',
            'date_added' => '06/02/2017',
            'name_video' => 'Demons - Imagine Dragons',
            'url' => 'https://www.youtube.com/watch?v=mWRsgZuwf_8',
            'views' => '0',
            'id_band' => '8',
            'id_video' => '6',

        ]);

        DB::table('battles')->insert([
            'id' => '7',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'All of Me - John Legend',
            'url' => 'https://www.youtube.com/watch?v=450p7goxZqg',
            'views' => '0',
            'id_band' => '9',
            'id_video' => '3',

        ]);

        DB::table('battles')->insert([
            'id' => '8',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '120',
            'llave' => '2',
            'date_added' => '06/02/2017',
            'name_video' => 'Thinking Out Loud - Ed Sheeran',
            'url' => 'https://www.youtube.com/watch?v=lp-EO5I60KA',
            'views' => '0',
            'id_band' => '3',
            'id_video' => '8',

        ]);

        DB::table('battles')->insert([
            'id' => '9',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Never Be Alone - Shawn Mendes',
            'url' => 'https://www.youtube.com/watch?v=N7VCLNBNJQs',
            'views' => '0',
            'id_band' => '7',
            'id_video' => '9',

        ]);

        DB::table('battles')->insert([
            'id' => '10',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Cold - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=XatXy6ZhKZw',
            'views' => '0',
            'id_band' => '1',
            'id_video' => '10',

        ]);

        DB::table('battles')->insert([
            'id' => '11',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Sugar - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=09R8_2nJtjg',
            'views' => '0',
            'id_band' => '1',
            'id_video' => '11',

        ]);

        DB::table('battles')->insert([
            'id' => '12',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Moves Like Jagger - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=iEPTlhBmwRg',
            'views' => '0',
            'id_band' => '1',
            'id_video' => '12',

        ]);

        DB::table('battles')->insert([
            'id' => '13',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Misery - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=6g6g2mvItp4',
            'views' => '0',
            'id_band' => '1',
            'id_video' => '13',

        ]);

        DB::table('battles')->insert([
            'id' => '14',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Chained to the Rhythm - Katy Perry',
            'url' => 'https://www.youtube.com/watch?v=Um7pMggPnug',
            'views' => '0',
            'id_band' => '5',
            'id_video' => '14',

        ]);

        DB::table('battles')->insert([
            'id' => '15',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Roar - Katy Perry',
            'url' => 'https://www.youtube.com/watch?v=CevxZvSJLk8',
            'views' => '0',
            'id_band' => '5',
            'id_video' => '15',

        ]);

        DB::table('battles')->insert([
            'id' => '16',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Shape of You - Ed Sheeran',
            'url' => 'https://www.youtube.com/watch?v=JGwWNGJdvx8',
            'views' => '0',
            'id_band' => '3',
            'id_video' => '16',

        ]);

        DB::table('battles')->insert([
            'id' => '17',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'King - Years & Years',
            'url' => 'https://www.youtube.com/watch?v=g_uoH6hJilc',
            'views' => '0',
            'id_band' => '2',
            'id_video' => '17',

        ]);
        DB::table('battles')->insert([
            'id' => '18',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => '24K Magic - Bruno Mars',
            'url' => 'https://www.youtube.com/watch?v=UqyT8IEBkvY',
            'views' => '0',
            'id_band' => '4',
            'id_video' => '18',

        ]);

        DB::table('battles')->insert([
            'id' => '19',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'No Way No - MAGIC!',
            'url' => 'https://www.youtube.com/watch?v=HdobynnfKQE',
            'views' => '0',
            'id_band' => '6',
            'id_video' => '19',

        ]);

        DB::table('battles')->insert([
            'id' => '20',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Treat You Better - Shawn Mendes',
            'url' => 'https://www.youtube.com/watch?v=lY2yjAdbvdQ',
            'views' => '0',
            'id_band' => '7',
            'id_video' => '20',

        ]);

        DB::table('battles')->insert([
            'id' => '21',
            'status' => 'A',
            'date' => '06/02/2017',
            'votes' => '0',
            'llave' => '1',
            'date_added' => '06/02/2017',
            'name_video' => 'Radioactive - Imagine Dragons',
            'url' => 'https://www.youtube.com/watch?v=ktvTqknDobU',
            'views' => '0',
            'id_band' => '8',
            'id_video' => '21',

        ]);
        DB::table('battles')->insert([
            'id' => '22',
            'status' => 'A',
            'date' => '19/05/2017',
            'votes' => '200',
            'llave' => '2',
            'date_added' => '19/05/2017',
            'name_video' => 'Whiskey In The Jar - Metallica',
            'url' => 'https://www.youtube.com/watch?v=boanuwUMNNQ',
            'views' => '200',
            'id_band' => '10',
            'id_video' => '22',
        ]);
        DB::table('battles')->insert([
            'id' => '23',
            'status' => 'A',
            'date' => '19/05/2017',
            'votes' => '157',
            'llave' => '2',
            'date_added' => '19/05/2017',
            'name_video' => 'Enter Sandman - Metallica',
            'url' => 'https://www.youtube.com/watch?v=CD-E-LDc384',
            'views' => '157',
            'id_band' => '10',
            'id_video' => '23',
        ]);
        DB::table('battles')->insert([
            'id' => '24',
            'status' => 'A',
            'date' => '19/05/2017',
            'votes' => '175',
            'llave' => '2',
            'date_added' => '19/05/2017',
            'name_video' => 'Nothing Else Matters - Metallica',
            'url' => 'https://www.youtube.com/watch?v=tAGnKpE4NCI',
            'views' => '175',
            'id_band' => '10',
            'id_video' => '24',
        ]);
        DB::table('battles')->insert([
            'id' => '25',
            'status' => 'A',
            'date' => '19/05/2017',
            'votes' => '125',
            'llave' => '2',
            'date_added' => '19/05/2017',
            'name_video' => 'Moth into flames - Metallica',
            'url' => 'https://www.youtube.com/watch?v=4tdKl-gTpZg',
            'views' => '125',
            'id_band' => '10',
            'id_video' => '25',
        ]);

    }
}
