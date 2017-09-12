<?php

use Illuminate\Database\Seeder;

class MusiciansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('musicians')->insert([
            'id' => '1',
            'artistic_name' => 'Adam Levine',
            'role' => 'a:2:{i:0;s:3:"VOZ";i:1;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/adam.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '3',
        ]);

        DB::table('musicians')->insert([
            'id' => '2',
            'artistic_name' => 'Mickey Madden',
            'role' => 'a:1:{i:0;s:4:"BAJO";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '4',
        ]);

        DB::table('musicians')->insert([
            'id' => '3',
            'artistic_name' => 'James Valentine',
            'role' => 'a:1:{i:0;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '5',
        ]);

        DB::table('musicians')->insert([
            'id' => '4',
            'artistic_name' => 'Matt Flynn',
            'role' => 'a:1:{i:0;s:8:"BATERÍA";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '6',
        ]);

        DB::table('musicians')->insert([
            'id' => '5',
            'artistic_name' => 'Jesse Carmichael',
            'role' => 'a:2:{i:0;s:8:"TECLADOS";i:1;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '7',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '6',
            'artistic_name' => 'P. J. Morton',
            'role' => 'a:1:{i:0;s:8:"TECLADOS";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '8',
        ]);
         
        DB::table('musicians')->insert([
            'id' => '7',
            'artistic_name' => 'Olly Alexander',
            'role' => 'a:3:{i:0;s:3:"VOZ";i:1;s:8:"TECLADOS";i:2;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/olly.jpg',
            'genres' => 'a:2:{i:0;s:10:"ELECTRONIC";i:1;s:3:"POP";}',
            'id_user' => '10',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '8',
            'artistic_name' => 'Mikey Goldsworthy',
            'role' => 'a:1:{i:0;s:4:"BAJO";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:10:"ELECTRONIC";i:1;s:3:"POP";}',
            'id_user' => '11',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '9',
            'artistic_name' => 'Emre Türkmen',
            'role' => 'a:2:{i:1;s:17:"PRODUCTOR MUSICAL";i:2;s:12:"SINTETIZADOR";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:10:"ELECTRONIC";i:1;s:3:"POP";}',
            'id_user' => '12',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '10',
            'artistic_name' => 'Ed Sheeran',
            'role' => 'a:2:{i:0;s:3:"VOZ";i:1;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/edsheeran.jpg',
            'genres' => 'a:3:{i:0;s:4:"FOLK";i:1;s:3:"POP";i:2;s:12:"R&B and SOUL";}',
            'id_user' => '13',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '11',
            'artistic_name' => 'Bruno Mars',
            'role' => 'a:7:{i:0;s:3:"VOZ";i:1;s:5:"PIANO";i:2;s:8:"TECLADOS";i:3;s:8:"GUITARRA";i:4;s:4:"BAJO";i:5;s:8:"BATERÍA";i:7;s:8:"trombón";}',
            'profile_pic' => '../../images/brunomars.jpg',
            'genres' => 'a:4:{i:0;s:7:"HIP HOP";i:1;s:3:"POP";i:2;s:12:"R&B and SOUL";i:3;s:4:"ROCK";}',
            'id_user' => '14',
        ]);
       
       	DB::table('musicians')->insert([
            'id' => '12',
            'artistic_name' => 'Katy Perry',
            'role' => 'a:3:{i:0;s:3:"VOZ";i:1;s:5:"PIANO";i:2;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/katyperry.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '15',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '13',
            'artistic_name' => 'Nasri Atweh',
            'role' => 'a:1:{i:0;s:3:"VOZ";}',
            'profile_pic' => '../../images/nasri.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '16',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '14',
            'artistic_name' => 'Mark Pellizzer',
            'role' => 'a:1:{i:0;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '17',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '15',
            'artistic_name' => 'Ben Spivak',
            'role' => 'a:1:{i:0;s:4:"BAJO";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '18',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '16',
            'artistic_name' => 'Alex Tanas',
            'role' => 'a:1:{i:0;s:8:"BATERÍA";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '19',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '17',
            'artistic_name' => 'Shawn Mendes',
            'role' => 'a:2:{i:0;s:3:"VOZ";i:1;s:8:"GUITARRA";}',
            'profile_pic' => '../../images/shawn.jpg',
            'genres' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
            'id_user' => '20',
        ]);
        
        DB::table('musicians')->insert([
            'id' => '18',
            'artistic_name' => 'Dan Reynolds',
            'role' => 'a:7:{i:0;s:3:"VOZ";i:1;s:5:"PIANO";i:2;s:8:"TECLADOS";i:3;s:8:"GUITARRA";i:4;s:8:"BATERÍA";i:5;s:10:"PERCUSIÓN";i:7;s:6:"LÍDER";}',
            'profile_pic' => '../../images/dan.jpg',
            'genres' => 'a:1:{i:0;s:4:"ROCK";}',
            'id_user' => '21',
        ]);
       
        DB::table('musicians')->insert([
            'id' => '19',
            'artistic_name' => 'Ben McKee',
            'role' => 'a:6:{i:0;s:4:"CORO";i:1;s:5:"PIANO";i:2;s:8:"TECLADOS";i:3;s:4:"BAJO";i:4;s:8:"BATERÍA";i:5;s:10:"PERCUSIÓN";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:1:{i:0;s:4:"ROCK";}',
            'id_user' => '22',
        ]);

        DB::table('musicians')->insert([
            'id' => '20',
            'artistic_name' => 'Daniel Wayne Sermon',
            'role' => 'a:5:{i:0;s:4:"CORO";i:1;s:8:"GUITARRA";i:2;s:8:"BATERÍA";i:3;s:10:"PERCUSIÓN";i:5;s:9:"MANDOLINA";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:1:{i:0;s:4:"ROCK";}',
            'id_user' => '23',
        ]);
        DB::table('musicians')->insert([
            'id' => '21',
            'artistic_name' => 'Daniel Platzman',
            'role' => 'a:6:{i:0;s:4:"CORO";i:1;s:8:"TECLADOS";i:2;s:8:"GUITARRA";i:3;s:8:"BATERÍA";i:4;s:10:"PERCUSIÓN";i:6;s:7:"VIOLÍN";}',
            'profile_pic' => '../../images/avatar.jpg',
            'genres' => 'a:1:{i:0;s:4:"ROCK";}',
            'id_user' => '24',
        ]);
        DB::table('musicians')->insert([
            'id' => '22',
            'artistic_name' => 'John Legend',
            'role' => 'a:6:{i:0;s:4:"CORO";i:1;s:5:"PIANO";i:2;s:8:"TECLADOS";i:3;s:4:"BAJO";i:4;s:8:"BATERÍA";i:5;s:10:"PERCUSIÓN";}',
            'profile_pic' => '../../images/johnlegend.jpg',
            'genres' => 'a:1:{i:0;s:4:"ROCK";}',
            'id_user' => '25',
        ]);

        DB::table('musicians')->insert([
            'id' => '23',
            'artistic_name' => 'James Hetfield',
            'about' => 'Es un músico estadounidense conocido por ser el vocalista y guitarrista rítmico de la banda de thrash metal Metallica, además de ser su compositor principal y co-fundador. Obtuvo el lugar número 87 en la lista Top 100 Greatest Guitarists por la revista Rolling Stone. En el libro The 100 Greatest Metal Guitarists de Joel McIver, James Hetfield está en el puesto número #8',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:3:"VOZ";i:2;s:16:"GUITARRA RITMICA";}',
            'profile_pic' => '../../images/jameshetfield.jpg',
            'genres' => 'a:2:{i:0;s:0:"";i:1;s:11:"TRASH METAL";}',
            'id_user' => '26',
        ]);

        DB::table('musicians')->insert([
            'id' => '24',
            'artistic_name' => 'Kirk Hammett',
            'about' => 'Es un guitarrista estadounidense, actualmente miembro de la banda de thrash metal Metallica. Sustituyó al anterior guitarrista Dave Mustaine, después de que éste tuviera problemas con la banda y fuera expulsado de Metallica. Está considerado como el noveno mejor guitarrista del momento según la revista Total Guitar y número 11 según una lista de la revista Rolling Stone seleccionada en 2003 por David Fricke, colaborador de la misma.1 Kirk es uno de los discípulos más conocidos del legendario guitarrista y maestro Joe Satriani.',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:4:"CORO";i:2;s:14:"GUITARRA LIDER";}',
            'profile_pic' => '../../images/kirkhammett.jpg',
            'genres' => 'a:2:{i:0;s:0:"";i:1;s:11:"TRASH METAL";}',
            'id_user' => '27',
        ]);
        DB::table('musicians')->insert([
            'id' => '25',
            'artistic_name' => 'Robert Trujillo',
            'about' => 'Es un músico estadounidense de ascendencia mexicana, actualmente bajista de la banda Metallica. Antes de ingresar en la mencionada banda, el 24 de febrero de 2003, Robert había tocado con artistas como Suicidal Tendencies, Black Label Society, Infectious Grooves, Ozzy Osbourne o Jerry Cantrell, entre otros. Entró a formar parte de Metallica tras la salida del grupo de Jason Newsted.',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:4:"CORO";i:2;s:14:"BAJO ELECTRICO";}',
            'profile_pic' => '../../images/roberttrujillo.jpg',
            'genres' => 'a:2:{i:0;s:0:"";i:1;s:11:"TRASH METAL";}',
            'id_user' => '28',
        ]);
        DB::table('musicians')->insert([
            'id' => '26',
            'artistic_name' => 'Lars Ulrich',
            'about' => 'Es un músico danés conocido principalmente por ser el baterista, compositor, fundador y colíder (junto a James Hetfield) de la banda de thrash metal estadounidense Metallica.  Nacido el 26 de diciembre de 1963 en Gentofte (Dinamarca), en el seno de una familia de clase media-alta. Siendo un prodigio de tenis en su juventud, Ulrich se trasladó a Los Ángeles, California, a la edad de dieciséis años para seguir con su educación, pero en vez de seguir jugando al tenis, decidió dedicarse a la batería. Después de publicar un anuncio en un periódico local de Los Ángeles llamado The Recycler, conoció a James Hetfield.',
            'role' => 'a:3:{i:0;s:0:"";i:1;s:8:"BATERÍA";i:2;s:10:"PERCUSIÓN";}',
            'profile_pic' => '../../images/larsulrich.jpg',
            'genres' => 'a:2:{i:0;s:0:"";i:1;s:11:"TRASH METAL";}',
            'id_user' => '29',
        ]);
    }
}
