<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type'); //Type of activity, example: Log in, Log Out, Views
            $table->integer('id_user')->nullable(); //User's activity registered 
            $table->integer('id_band')->nullable(); //Band's activity registered
            $table->integer('id_musician')->nullable(); //Musician's activity registered
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('advertisings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //Promotion name
            $table->string('image'); //Displayed on Banner
            $table->string('start_date'); //From date
            $table->string('end_date'); //To date
            $table->integer('id_sponsor')->nullable(); //If a sponsor requested the publicity
            $table->integer('id_band')->nullable(); //If a band requested the publicity
            $table->integer('id_user')->nullable();//If a user requested the publicity
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

         Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('id_user')->nullable(); //User who made the comment or the response
            $table->integer('id_wall')->nullable(); //Wall where the comment was made
            $table->integer('id_comment')->nullable(); //Band who made the comment or the response
            $table->integer('id_band')->nullable();
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('bands', function (Blueprint $table) {
            $table->increments('id');  
            $table->string('name');//Name displayed at your wall
            $table->text('about')->nullable();//Band's description displayed at your wall
            $table->string('profile_pic')->nullable();//Profile Picture displayed at your wall
            $table->string('background_pic')->nullable();//Background Picture displayed at your wall
            $table->string('back_y')->nullable();//Background Picture displayed at your wall
            $table->string('back_x')->nullable();//Background Picture displayed at your wall
            $table->string('country')->nullable();//Address
            $table->string('province');//Address
            $table->string('status', 1); // A for Able & D for disable
            $table->integer('admin')->nullable(); //Band's Administrator
            $table->integer('favorite')->default(0)->nullable(); //Ask if bands could have favorites
            $table->integer('id_user')->nullable();//Relation with Users
            $table->string('id_genre')->nullable();//Bands' genres
            $table->integer('id_video')->nullable();//Relation with Video
            $table->integer('id_comment')->nullable();//Relation with Comments
            $table->integer('id_publication')->nullable();//Relation with Publicity
            $table->integer('id_notification')->nullable();//Relation with Notifications
            $table->integer('id_battle')->nullable();//Relation with Battles
            $table->integer('id_permission')->nullable();//Relation with Permissions                 
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('battles', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('status', 1); //A for Able & D for Diasble
            $table->string('date'); //Date of the battle
            $table->integer('votes')->default(0)->nullable();
            $table->integer('likes')->default(0)->nullable();  //Number of votes
            $table->integer('llave')->nullable(); //Level on the competion
            $table->string('date_added')->nullable(); //Date when the video was uploaded
            $table->string('name_video')->nullable(); //Name of the video was uploaded
            $table->integer('views')->default(0)->nullable();// Keep counts of the views
            $table->integer('id_user')->nullable();//Who votes
            $table->integer('id_band')->nullable();//Who Participates
            $table->integer('id_video')->nullable(); //Logged Video
            $table->string('url', 250); //Virtual Address from YouTube
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment');//Comment body
            $table->string('title')->nullable();//Comment body
            $table->integer('like')->default(0)->nullable(); //Comment's number of likes 
            $table->string('id_comment')->nullable(); //Comment's response if it has
            $table->string('id_response')->nullable(); //Comment's response if it has
            $table->string('type')->nullable();
            $table->integer('id_album')->nullable();
            $table->integer('id_user')->nullable(); //User who made the comment or the response
            $table->integer('id_video')->nullable(); //User who made the comment or the response
            $table->integer('id_wall')->nullable(); //Wall where the comment was made
            $table->integer('id_band')->nullable(); //Band who made the comment or the response
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->nullable();//User's favorite videos and relation with Users table 
            $table->integer('id_band')->nullable();//Band's favorite videos && Ask if bands could have favorites
            $table->integer('id_video')->nullable();//Favorite videos and relation with Videos table
            $table->integer('id_musician')->nullable();//Favorite videos and relation with Videos table
            $table->integer('id_fan')->nullable();//Favorite videos and relation with Videos table
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //Genre Name (Rock, etc)
            $table->string('image'); //Image refer to the genre
            $table->string('color'); //To identify the genre
            $table->integer('id_video')->nullable(); //Relation with Video
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();

        });

        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role'); //If member is the voice or the guitar player...
            $table->string('id_user'); //User's id to become a band member
            $table->string('id_band'); //To identify the band
            $table->string('verified'); //Y is confirmed and N is for not
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();

        });

        Schema::create('musicians', function (Blueprint $table) {
            $table->increments('id');
            $table->string('artistic_name');
            $table->string('about')->nullable(); //Musician's story
            $table->string('role')->nullable(); //Musician's story
            $table->string('profile_pic')->nullable(); //Profile Picture
            $table->integer('favorite')->default(0)->nullable(); //Ask if bands could have favorites
            $table->string('genres'); //If member is the voice or the guitar player...
            $table->string('id_user'); //User's id to become a band member
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();

        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comment'); //Notification body
            $table->string('href')->nullable();
            $table->string('type')->nullable(); //Notification body
            $table->string('upload_date'); //Upload date
            $table->string('seen')->nullable(); //Y for seen & N for not seen
            $table->integer('id_user')->nullable();//Relation with the Users table
            $table->integer('id_band')->nullable();//Relation with the Bands table
            $table->integer('id_musician')->nullable();//Relation with the Musician table
            $table->integer('id_video')->nullable();//Relation with Videos Table
            $table->integer('id_comment')->nullable();//Relation with Videos Table
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('pv_bandvideo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_band')->nullable();
            $table->integer('id_video')->nullable();
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('pv_usercomment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->nullable();
            $table->integer('id_comment')->nullable();
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('pv_uservideo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->nullable();
            $table->integer('id_video')->nullable();
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

         Schema::create('pv_uservotes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_battle')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('llave')->nullable();
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('pv_videoview', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->nullable();
            $table->integer('id_video')->nullable();
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });


        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //Sponsor's name
            $table->string('image'); //Sponsor's Official Logo
            $table->string('url', 250); //Sponsor's official web site
            $table->integer('id_user')->nullable(); //If a user is sponsored
            $table->integer('id_band')->nullable(); //If a band is sponsored
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('upermissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('per_name'); //Name of the privilege
            $table->integer('id_user')->nullable(); //User who has privileges
            $table->integer('id_band')->nullable(); //Band who has privileges
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');  
            $table->string('email', 100)->unique(); //For Login
            $table->string('password', 100)->nullable(); //For Login
            $table->tinyInteger('verified')->default(0); // this column will be a TINYINT with a default value of 0 , [0 for false & 1 for true i.e. verified]
            $table->string('zipcode')->nullable();
            $table->string('email_token', 250)->nullable(); // this column will be a VARCHAR with no default value and will also BE NULLABLE
            $table->string('profile_pic')->nullable(); //Profile Picture
            $table->string('background_pic')->nullable();//Background Picture displayed at your wall
            $table->string('back_y')->nullable();//Background Picture displayed at your wall
            $table->string('back_x')->nullable();//Background Picture displayed at your wall
            $table->string('name'); //Name displayed at your wall
            $table->string('country'); //Address
            $table->string('province'); //Address
            $table->string('followers')->default(0); //Address
            $table->string('status', 1); // A for Able & D for disable
            $table->string('user_level', 1); //1 for SuperAd, 2 for Admin, 3 for Bands, 4 for Fans, 5 for musicians
            $table->integer('activity_count')->default(0)->nullable(); //Ask if bands could have favorites
            $table->string('id_musician')->nullable();
            $table->string('id_genre')->nullable();
            $table->integer('id_favorite')->nullable(); //User's favorites videos 
            $table->integer('id_video')->nullable(); //Relation with Videos
            $table->integer('id_band')->nullable(); //Band member & relation with Bands
            $table->integer('id_comment')->nullable(); //Relation with comments, to know which comment the user made
            $table->integer('id_response')->nullable(); //Relation with comments, to know which comment the user made
            $table->integer('id_publication')->nullable();//Relation with publicity
            $table->integer('id_notification')->nullable(); //Relation with publicity & User notification
            $table->integer('id_battle')->nullable(); //Relation with battles the user vote at
            $table->integer('id_permission')->nullable(); //Permissions table
            $table->integer('id_wall')->nullable(); //Relation with Wall                  
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });      
        
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //Video Name
            $table->string('url', 250); //Virtual Address from YouTube
            $table->string('upload_date'); //Upload date
            $table->integer('votes')->default(0)->nullable();
            $table->integer('likes')->default(0)->nullable(); //Like the video
            $table->integer('views')->default(0)->nullable(); //Number of views the video has
            $table->integer('id_genre')->nullable(); //Music Genre and relation with Genres table
            $table->integer('id_band')->nullable();//Relation with Bands
            $table->integer('id_musician')->nullable();//Relation with Bands
            $table->integer('id_battle')->nullable();//Relation with Battles
            $table->integer('id_user')->nullable();//Relation with Users
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('walls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('state'); //Publication head or the text the user/band wants to share
            $table->string('attachment')->nullable(); //If the user/band wants to share videos or photos
            $table->integer('id_comment')->nullable(); //To enable comments on the publication
            $table->integer('like')->nullable(); //To count the number of likes the publication has
            $table->integer('id_user')->nullable(); //User's wall && Relation with Users table
            $table->integer('id_band')->nullable(); //Band's wall && Relation with Bands table
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });

        Schema::create('winners', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_band'); //Who won
            $table->integer('id_looser'); //Who lost
            $table->string('user_location')->nullable(); //For the final battle location\\
            $table->string('user_province')->nullable(); //For the final battle location\\
            $table->integer('id_video')->nullable(); //Video that won
            $table->string('remember_token', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activities');
        Schema::drop('advertisings');
        Schema::drop('albums');
        Schema::drop('bands');
        Schema::drop('battles');
        Schema::drop('comments');
        Schema::drop('favorites');
        Schema::drop('genres');
        Schema::drop('members');
        Schema::drop('musicians');
        Schema::drop('notifications');
        Schema::drop('pv_bandvideo');
        Schema::drop('pv_uservideo');
        Schema::drop('pv_uservotes');
        Schema::drop('pv_videoview');
        Schema::drop('sponsors');
        Schema::drop('upermissions');
        Schema::drop('users');
        Schema::drop('videos');
        Schema::drop('walls');
        Schema::drop('winners');
    }
}
