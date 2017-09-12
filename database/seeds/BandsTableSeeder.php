<?php

use Illuminate\Database\Seeder;

class BandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bands')->insert([
            'id' => '1',
            'name' => 'Maroon 5',
            'about' => 'Es una banda musical de pop rock y pop estadounidense. El grupo se formó originalmente entre 1994 y 1995 como Karas Flowers mientras sus integrantes cursaban la secundaria. Adam Levine, Jesse Carmichael, Mickey Madden y Ryan Dusick firmaron con A&M Records y lanzaron un álbum, The Fourth World, en 1997. Después de una respuesta indiferente al álbum, la banda se separó de su sello discográfico y siguieron con sus carreras académicas en la universidad. En 2001, la banda se reagrupó, añadió a James Valentine a la agrupación, y siguió una nueva dirección bajo el nombre de Maroon 5.',
            'profile_pic' => '../../images/M5.jpg',
            'province' => 'CABA',
            'admin' => '3',
            'status' => 'A',
            'id_genre' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
        ]);

        DB::table('bands')->insert([
            'id' => '2',
            'name' => 'Years & Years',
            'about' => 'Es un trío británico de música electrónica formado en Londres, saltaron a la fama en el 2015 tras ganar la encuesta de BBC, Sound of..., y posteriormente con el lanzamiento de su álbum Communion, que logró el número uno en el Reino Unido e Irlanda. El disco produjo los éxitos «King» y «Shine», que ingresaron a los treinta primeros de numerosos países, destacando Alemania y Australia, así como el Reino Unido e Irlanda',
            'profile_pic' => '../../images/yearsandyears.jpg',
            'province' => 'CABA',
            'admin' => '10',
            'status' => 'A',
            'id_genre' => 'a:2:{i:0;s:10:"ELECTRONIC";i:1;s:3:"POP";}',
        ]);

        DB::table('bands')->insert([
            'id' => '3',
            'name' => 'Ed Sheeran',
            'about' => 'Es un cantante y compositor británico. A corta edad, comenzó a cantar en la iglesia a la que asistía y también aprendió a tocar la guitarra. A los dieciséis años abandonó la escuela secundaria, y se trasladó a Londres para perseguir una carrera artística. Después de publicar un EP de forma independiente a principios de 2011, captó la atención de Elton John quien lo puso en contacto con el sello Asylum Records y firmó un acuerdo de grabación. En septiembre de 2011 lanzó su álbum debut +, que tuvo un éxito comercial y en la lista musical de discos de Reino Unido. El álbum consta del sencillo «The A Team» que estuvo nominada a un grammy por canción del año. En 2012 Sheeran ganó los galardones artista revelación británico y solista británico masculino en los Brit Awards. Él actuó como telonero de Taylor Swift en su gira Red Tour durante varios meses de 2013 y en 2014 optó al galardón mejor artista nuevo de los Premios Grammy.',
            'profile_pic' => '../../images/edsheeran.jpg',
            'province' => 'CABA',
            'admin' => '13',
            'status' => 'A',
            'id_genre' => 'a:3:{i:0;s:4:"FOLK";i:1;s:3:"POP";i:2;s:12:"R&B and SOUL";}',
        ]);

        DB::table('bands')->insert([
            'id' => '4',
            'name' => 'Bruno Mars',
            'about' => 'Es un cantante, compositor, productor musical y coreógrafo estadounidense. Nació y se crió en Honolulú, Hawái, dentro de una familia de músicos, Mars comenzó a crear música desde una edad temprana y actuó en muchos escenarios de su pueblo natal a lo largo de su niñez realizando imitaciones. Se graduó de la escuela secundaria y se mudó a Los Ángeles, California para proseguir con su carrera musical. Después de una temporada sin éxito con Motown Records, Mars firmó con Atlantic Records en 2009. Llegó a ser reconocido como artista en solitario después de prestar su voz y haber coescrito los coros para las canciones «Nothin on You» de B.o.B, y «Billionaire» de Travie McCoy. También coescribió los éxitos internacionales «Right Round» de Flo Rida, «Wavin Flag» de Knaan y «Fuck You!» de Cee Lo Green.',
            'profile_pic' => '../../images/brunomars.jpg',
            'province' => 'CABA',
            'admin' => '15',
            'status' => 'A',
            'id_genre' => 'a:4:{i:0;s:7:"HIP HOP";i:1;s:3:"POP";i:2;s:12:"R&B and SOUL";i:3;s:4:"ROCK";}',
        ]);

        DB::table('bands')->insert([
            'id' => '5',
            'name' => 'Katy Perry',
            'about' => 'Es una cantante y compositora estadounidense, que saltó a la fama en 2008 con «I Kissed a Girl» y «Hot n Cold» de su segundo álbum One of the Boys (2008). Entre 2010 y 2011, tuvo aún mayor éxito con Teenage Dream, que para su promoción lanzó seis sencillos de los cuales cinco —«California Gurls», «Teenage Dream», «Firework», «E.T» y «Last Friday Night (T.G.I.F.)»— se ubicaron en el puesto número 1 del Billboard Hot 100, lo que la convirtió en la primera artista femenina en lograr dicha hazaña y la segunda en general después de Michael Jackson con su álbum Bad (1987). Posteriormente, en 2012 publicó los temas «Part of Me» y «Wide Awake», que también tuvieron éxito en varios países. Su cuarto álbum, Prism (2013) generó dos sencillos superventas, «Roar» y «Dark Horse», que encabezaron varias listas de popularidad.',
            'profile_pic' => '../../images/katyperry.jpg',
            'province' => 'CABA',
            'admin' => '16',
            'status' => 'A',
            'id_genre' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
        ]);

        DB::table('bands')->insert([
            'id' => '6',
            'name' => 'MAGIC!',
            'about' => 'Es una banda canadiense de reggae-pop, compuesta por el compositor y productor discográfico Nasri Atweh en la voz principal y Mark Pellizzer, Alex Tanas y Ben Spivak. En 2013, lanzaron su single de debut, «Rude»1 que alcanzó el número dos en Australia y Nueva Zelanda y el número siete en Canadá. MAGIC! aparece en el álbum homónimo de Shakira en la canción titulada «Cut me deep», lanzado en marzo de 2014.',
            'profile_pic' => '../../images/magic.jpg',
            'province' => 'CABA',
            'admin' => '17',
            'status' => 'A',
            'id_genre' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
        ]);

        DB::table('bands')->insert([
            'id' => '7',
            'name' => 'Shawn Mendes',
            'about' => 'Es una banda canadiense de reggae-pop, compuesta por el compositor y productor discográfico Nasri Atweh en la voz principal y Mark Pellizzer, Alex Tanas y Ben Spivak. En 2013, lanzaron su single de debut, «Rude»1 que alcanzó el número dos en Australia y Nueva Zelanda y el número siete en Canadá. MAGIC! aparece en el álbum homónimo de Shakira en la canción titulada «Cut me deep», lanzado en marzo de 2014.',
            'profile_pic' => '../../images/shawn.jpg',
            'province' => 'CABA',
            'admin' => '21',
            'status' => 'A',
            'id_genre' => 'a:2:{i:0;s:3:"POP";i:1;s:4:"ROCK";}',
        ]);

        DB::table('bands')->insert([
            'id' => '8',
            'name' => 'Imagine Dragons',
            'about' => 'Es una banda estadounidense de indie rock originaria de Las Vegas, Nevada. Actualmente está compuesta por Dan Reynolds (vocalista), Wayne Sermon (guitarrista), Ben McKee (bajista) y Daniel Platzman (baterista).1 La banda ganó el reconocimiento mundial con el lanzamiento de su álbum de estudio debut Night Visions (2012), y con su sencillo "Its Time". Billboard colocó a Imagine Dragons en la cima de su ranking del 2013 "Year In Rock", además los llamó «la banda revelación del 2013».2 La revista Rolling Stone llamó a su sencillo Radioactive de Night Visions «el mayor éxito rock del año».3 1 4 MTV los llamó «la banda revelación del año».5 Night Visions alcanzó su punto máximo en el número dos de la lista semanal Billboard 200 y en UK Albums Chart. Su segundo álbum de estudio, Smoke + Mirrors, alcanzó el número uno en los Estados Unidos, Canadá y el Reino Unido.',
            'profile_pic' => '../../images/imaginedragons.jpg',
            'province' => 'CABA',
            'admin' => '22',
            'status' => 'A',
            'id_genre' => 'a:1:{i:0;s:4:"ROCK";}',
        ]);

        DB::table('bands')->insert([
            'id' => '9',
            'name' => 'John Legend',
            'about' => 'Es un cantante, compositor, pianista y actor estadounidense. Ha ganado diez premios Grammy, un Premio Globo de Oro y un Oscar. En 2007, Legend recibió el Premio "Hal David Starlight " del Salón de la Fama de los Compositores. Antes del lanzamiento del álbum debut de Legend, su carrera ganó ímpetu a través de una serie de colaboraciones con varios artistas de renombre. En varios puntos de su carrera, Legend ha colaborado en sencillos como "Getting Nowhere" de Magnetic Man, "All the Lights" de Kanye West, en "This Way", de Slow Village. Además de participar en "Encore" de Jay Z, en el coro de la canción de Alicia Keys, "You Dont Know My Name", el rémix que hizo Kanye West a la canción de Britney Spears "Me Against the Music" y "High Road" de Fort Minor. Legend tocó el piano en "Everything Is Everything" de Lauryn Hill. Por su trabajo en solitario, ganó un "Número 1" en la lista Billboard Hot 100 con "All of Me" en 2013. Ganó el Premio de la Academia a la Mejor Canción Original en 2015 por escribir la canción "Glory" de la película Selma.',
            'profile_pic' => '../../images/johnlegend.jpg',
            'province' => 'CABA',
            'admin' => '25',
            'status' => 'A',
            'id_genre' => 'a:3:{i:0;s:4:"FOLK";i:1;s:3:"POP";i:2;s:12:"R&B and SOUL";}',
        ]);

        DB::table('bands')->insert([
            'id' => '10',
            'name' => 'Metallica',
            'about' => 'Es una banda de thrash metal estadounidense originaria de Los Ángeles, pero con base en San Francisco desde febrero de 1983. Fue fundada en 1981 en Los Ángeles por Lars Ulrich y James Hetfield, a los que se les unirían Dave Mustaine y Cliff Burton. Estos dos músicos fueron después sustituidos por el guitarrista Kirk Hammett y el bajista Jason Newsted, Dave Mustaine fue despedido un año después de ingresar en la banda debido a su excesiva adicción al alcohol y su actitud violenta, y fundó la banda Megadeth, siendo sustituido por Kirk Hammett ex guitarrista de Exodus. Por otra parte, el 27 de septiembre de 1986, la muerte de Cliff Burton en un accidente de autobús en Suecia, durante una de sus giras, provocó la entrada al grupo de Jason Newsted,1 quien, tras su abandono quince años más tarde, sería sustituido por el bajista actual, Robert Trujillo.',
            'profile_pic' => '../../images/metallica.jpg',
            'province' => 'CABA',
            'admin' => '27',
            'status' => 'A',
            'id_genre' => 'a:2:{i:0;s:0:"";i:1;s:11:"TRASH METAL";}',
        ]);
    }
}
