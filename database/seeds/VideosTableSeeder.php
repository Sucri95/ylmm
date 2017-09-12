<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            'id' => '1',
            'name' => 'Shine - Years & Years',
            'url' => 'https://www.youtube.com/watch?v=hXTAn4ELEwM',
            'upload_date' => '06/02/2017',
            'id_band' => '2',
            'id_genre' => '3',

        ]);

        DB::table('videos')->insert([
            'id' => '2',
            'name' => 'Unkiss Me - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=ZK7hdWwIEkI',
            'upload_date' => '06/02/2017',
            'id_band' => '1',
            'id_genre' => '10',

        ]);

        DB::table('videos')->insert([
            'id' => '3',
            'name' => 'Lost Stars - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=cL4uhaQ58Rk',
            'upload_date' => '06/02/2017',
            'id_band' => '1',
            'id_genre' => '10',
        ]);

          DB::table('videos')->insert([
            'id' => '4',
            'name' => 'Rude - MAGIC!',
            'url' => 'https://www.youtube.com/watch?v=PIh2xe4jnpk',
            'upload_date' => '06/02/2017',
            'id_band' => '6',
            'id_genre' => '9',

        ]);

        DB::table('videos')->insert([
            'id' => '5',
            'name' => 'Uptown Funk - Bruno Mars',
            'url' => 'https://www.youtube.com/watch?v=OPf0YbXqDm0',
            'upload_date' => '06/02/2017',
            'id_band' => '4',
            'id_genre' => '8',

        ]);

        DB::table('videos')->insert([
            'id' => '6',
            'name' => 'Demons - Imagine Dragons',
            'url' => 'https://www.youtube.com/watch?v=mWRsgZuwf_8',
            'upload_date' => '06/02/2017',
            'id_band' => '8',
            'id_genre' => '10',
        ]);
          DB::table('videos')->insert([
            'id' => '7',
            'name' => 'All of Me - John Legend',
            'url' => 'https://www.youtube.com/watch?v=450p7goxZqg',
            'upload_date' => '06/02/2017',
            'id_band' => '9',
            'id_genre' => '9',

        ]);

        DB::table('videos')->insert([
            'id' => '8',
            'name' => 'Thinking Out Loud - Ed Sheeran',
            'url' => 'https://www.youtube.com/watch?v=lp-EO5I60KA',
            'upload_date' => '06/02/2017',
            'id_band' => '3',
            'id_genre' => '9',

        ]);

        DB::table('videos')->insert([
            'id' => '9',
            'name' => 'Never Be Alone - Shawn Mendes',
            'url' => 'https://www.youtube.com/watch?v=N7VCLNBNJQs',
            'upload_date' => '06/02/2017',
            'id_band' => '7',
            'id_genre' => '9',
        ]);

        DB::table('videos')->insert([
            'id' => '10',
            'name' => 'Cold - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=XatXy6ZhKZw',
            'upload_date' => '06/02/2017',
            'id_band' => '1',
            'id_genre' => '10',
        ]);

        DB::table('videos')->insert([
            'id' => '11',
            'name' => 'Sugar - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=09R8_2nJtjg',
            'upload_date' => '06/02/2017',
            'id_band' => '1',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '12',
            'name' => 'Moves like Jagger - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=iEPTlhBmwRg',
            'upload_date' => '06/02/2017',
            'id_band' => '1',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '13',
            'name' => 'Misery - Maroon 5',
            'url' => 'https://www.youtube.com/watch?v=6g6g2mvItp4',
            'upload_date' => '06/02/2017',
            'id_band' => '1',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '14',
            'name' => 'Chained to the rhythm - Katy Perry',
            'url' => 'https://www.youtube.com/watch?v=Um7pMggPnug',
            'upload_date' => '09/03/2017',
            'id_band' => '5',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '15',
            'name' => 'Roar - Katy Perry',
            'url' => 'https://www.youtube.com/watch?v=CevxZvSJLk8',
            'upload_date' => '09/03/2017',
            'id_band' => '5',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '16',
            'name' => 'Shape of you - Ed Sheeran',
            'url' => 'https://www.youtube.com/watch?v=JGwWNGJdvx8',
            'upload_date' => '09/03/2017',
            'id_band' => '3',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '17',
            'name' => 'King - Years & Years',
            'url' => 'https://www.youtube.com/watch?v=g_uoH6hJilc',
            'upload_date' => '09/03/2017',
            'id_band' => '2',
            'id_genre' => '3',
        ]);

        DB::table('videos')->insert([
            'id' => '18',
            'name' => '24K Magic- Bruno Mars',
            'url' => 'https://www.youtube.com/watch?v=UqyT8IEBkvY',
            'upload_date' => '09/03/2017',
            'id_band' => '4',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '19',
            'name' => 'No way no - MAGIC!',
            'url' => 'https://www.youtube.com/watch?v=HdobynnfKQE',
            'upload_date' => '09/03/2017',
            'id_band' => '6',
            'id_genre' => '3',
        ]);

        DB::table('videos')->insert([
            'id' => '20',
            'name' => 'Treat you better - Shawn Mendes',
            'url' => 'https://www.youtube.com/watch?v=lY2yjAdbvdQ',
            'upload_date' => '09/03/2017',
            'id_band' => '7',
            'id_genre' => '8',
        ]);

        DB::table('videos')->insert([
            'id' => '21',
            'name' => 'Radioactive - Imagine Dragons',
            'url' => 'https://www.youtube.com/watch?v=ktvTqknDobU',
            'upload_date' => '09/03/2017',
            'id_band' => '8',
            'id_genre' => '10',
        ]);

        DB::table('videos')->insert([
            'id' => '22',
            'name' => 'Whiskey In The Jar - Metallica',
            'url' => 'https://www.youtube.com/watch?v=boanuwUMNNQ',
            'upload_date' => '19/05/2017',
            'views' => '200',
            'id_band' => '10',
            'id_genre' => '10',
        ]);
        DB::table('videos')->insert([
            'id' => '23',
            'name' => 'Enter Sandman - Metallica',
            'url' => 'https://www.youtube.com/watch?v=CD-E-LDc384',
            'upload_date' => '19/05/2017',
            'views' => '157',
            'id_band' => '10',
            'id_genre' => '10',
        ]);
        DB::table('videos')->insert([
            'id' => '24',
            'name' => 'Nothing Else Matters - Metallica',
            'url' => 'https://www.youtube.com/watch?v=tAGnKpE4NCI',
            'upload_date' => '19/05/2017',
            'views' => '175',
            'id_band' => '10',
            'id_genre' => '10',
        ]);
        DB::table('videos')->insert([
            'id' => '25',
            'name' => 'Moth into flames - Metallica',
            'url' => 'https://www.youtube.com/watch?v=4tdKl-gTpZg',
            'upload_date' => '19/05/2017',
            'views' => '125',
            'id_band' => '10',
            'id_genre' => '10',
        ]);
    }
}
