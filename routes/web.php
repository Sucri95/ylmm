<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Checking if the environment is debug, because we don't want to disable cache in production
$middleware = [];
if(Config::get('app.debug'))
{
	array_push($middleware, ['middleware' => 'clearcache']);
}

// The route group that will pass every request to a Middleware
Route::group($middleware, function() {


Route::get('/mailbladeregistro', 'AdminController@mailBlade');
Route::get('/basicemail', 'MailController@basic_email');
Route::get('/htmlemail', 'MailController@html_email');
Route::get('/attachemail', 'MailController@attachment_email');
Route::get('/search', 'HomeController@search_get');
Route::get('/search_members', 'HomeController@search_members');
Route::get('/searchresults', 'HomeController@makeResults');
Route::get('/emailvalidation', 'AdminController@emailValidator');
Route::get('/followers', 'AdminController@makeFollowers');
Route::get('/followings', 'AdminController@makeFollowings');

Route::get('/', 'HomeController@home_view');
Route::get('/login', 'HomeController@make_login');
Route::post('/users/wall', 'HomeController@login');
Route::get('/logout', 'HomeController@logout');
Route::get('/redirect/google', 'HomeController@redirectToProvider');
Route::get('/callback/google', 'HomeController@handleProviderCallback');
Route::get('/redirect/facebook', 'HomeController@redirectToProviderFacebook');
Route::get('/callback/facebook', 'HomeController@handleProviderCallbackFacebook');

Route::get('/dataupdate', 'AdminController@makePassword');
Route::post('/dataupdate', 'AdminController@setPassword');
Route::get('/fansregistration', 'AdminController@makePasswordFan');
Route::post('/fansregistration', 'AdminController@setPasswordFan');

Route::get('/youtube', array('uses' => 'YoutubeController@index', 'as' => 'youtube'));
Route::post('/youtube', array('uses' => 'YoutubeController@search', 'as' => 'youtube.search'));

//Activity's Routes
Route::get('/activities/registration', 'ActivityController@createactivity');
//Admin's Routes
Route::get('/registro', 'AdminController@registro');
Route::post('/users/registro', 'AdminController@creator');
//Advertising's Routes
Route::get('/advertisings/create', 'AdvertisingController@createadvertising');
//Band's Routes
Route::post('/bands/update_profile', 'BandController@update_profile');
Route::post('/bands/update_background', 'BandController@update_background');
Route::get('/bands/about', 'BandController@about');
Route::post('/bands/edit/about', 'BandController@editAbout');
Route::post('/bands/set/about', 'BandController@setBandAbout');
Route::get('/bands/delete/member', 'BandController@deleteMember');
Route::get('/bands/comments', 'BandController@comments');
Route::get('/bands/home_band', 'BandController@home_band');
Route::get('/bands/band_comments', 'BandController@band_comments');
Route::get('/bandsregistration', 'BandController@make_bands');
Route::post('/bandsregistration', 'BandController@creator');
Route::get('/bands/login', 'BandController@login');
Route::post('/bands/login', 'BandController@bandlogin');
Route::get('/makefan', 'BandController@addFan');
Route::get('/videos/addLike', 'BandController@videoLike');
Route::get('/bands/addmember', 'BandController@addmemberview');
Route::post('/bands/addmember', 'BandController@addmember');
Route::post('/bands/edit/member', 'BandController@editMember');
Route::post('/bands/edit/genre', 'BandController@editGenre');
Route::get('/membersvalidation', 'BandController@membersValidator');
Route::post('/bands/edit/name', 'BandController@editNameBand');
Route::get('/bands/followers', 'BandController@showFollowers');
//Battle's Routes
Route::get('/battles', 'BattleController@battle');
Route::get('/battles/create', 'BattleController@createbattle');
Route::post('/battles/create', 'BattleController@creator');
Route::get('/battles/battle_comment', 'BattleController@battle_comment');
Route::get('/battles/letters', 'BattleController@letters');
Route::get('/battles/llaves', 'BattleController@llaves');
Route::get('/battles/lastadded', 'BattleController@lastadded');
Route::get('/battles/views', 'BattleController@views');
Route::get('/battles/mostvoted', 'BattleController@mostvoted');
Route::get('/battles/key', 'BattleController@key_view');
Route::get('/battles/firstkey', 'BattleController@firstkey_view');
Route::post('/battles/votes', 'BattleController@elections');
Route::get('/battles/secondkey', 'BattleController@secondkey_view');
Route::post('/battles/secondkey', 'BattleController@secondkey_votes');
Route::get('/battles/thirdkey', 'BattleController@thirdkey_view');
Route::post('/battles/thirdkey', 'BattleController@thirdkey_votes');
Route::get('/battles/fourthkey', 'BattleController@fourthkey_view');
Route::post('/battles/fourthkey', 'BattleController@fourthkey_votes');
Route::get('/battles/fifthkey', 'BattleController@fifthkey_view');
Route::post('/battles/fifthkey', 'BattleController@fifthkey_votes');
Route::get('/battles/sixthkey', 'BattleController@sixthkey_view');
Route::post('/battles/sixthkey', 'BattleController@sixthkey_votes');
Route::get('/battles/addVote', 'BattleController@addVote');
Route::get('/battles/search_musicians', 'BattleController@performance_search');


Route::get('/battles/firstkey', 'BattleController@firstkey_view');
Route::post('/battles/votes', 'BattleController@elections');
//Comment's Routes
Route::post('/bands/band_comments/videos', 'CommentController@createcomment');
Route::post('/bands/wall/comment', 'CommentController@commentband');
Route::post('/users/wall/comment', 'CommentController@commentuser');
Route::get('/bands/band_comments/addLike', 'CommentController@addLike');
Route::get('/bands/test', 'CommentController@test');
Route::get('/bands/testhtml', 'CommentController@testhtml');
Route::get('/users/commenthtml', 'CommentController@commenthelper');
Route::post('pictures', 'CommentController@uploadPic');
Route::get('/deletecomment', 'CommentController@delete');
Route::get('/editcomment', 'CommentController@editComment');
Route::get('/edittitle', 'CommentController@editTitle');
Route::post('uploadvideo', 'CommentController@uploadVideo');
Route::post('pictureWall', 'CommentController@pictureWall');
Route::post('videoWall', 'CommentController@videoWall');
Route::get('/walls/response', 'CommentController@commentresponsewall');
Route::get('/bands/response', 'CommentController@createresponseband');

Route::post('/multipictures', 'CommentController@multiple_upload');
//Fan's Routes
Route::post('/users/update_profile', 'FanController@update_profile');
Route::post('/users/update_background', 'FanController@update_background');
Route::get('/users/create_fan', 'FanController@createfan');
Route::post('/users/create_fan', 'FanController@creator');
Route::get('/users/fan/addView', 'FanController@addView');
Route::get('/users/favorites', 'FanController@favorites');
Route::get('/users/lastadded', 'FanController@lastadded');
Route::get('/users/mostviews', 'FanController@mostviews');
Route::get('/users/thisweek', 'FanController@thisweek');
Route::get('/users/wall', 'FanController@wall');
Route::get('/wall', 'FanController@generalwall');
Route::get('/wall/yourfavorites', 'FanController@yourFavorites');
Route::get('addfollower', 'FanController@addFollowerFan');
Route::post('/users/edit/name', 'FanController@editNameUser');

//Favorite's Routes
Route::get('/favorites/create', 'FavoriteController@createfavorite');
//Genre's Routes
Route::get('/genres/create', 'GenreController@creategenre');
//Musician's Routes
Route::get('/musician/videos', 'MusicianController@videos_view');
Route::post('/musician/videos', 'MusicianController@creator_music');
Route::get('/musician/musician_comments', 'MusicianController@comments_view');
Route::get('/musicianregistration', 'MusicianController@musicianView');
Route::post('/musicianregistration', 'MusicianController@musicianRegistration');
Route::get('/musicianregistration', 'MusicianController@musicianView');
Route::get('/musician/about', 'MusicianController@aboutMusician');
Route::post('/musician/about/edit', 'MusicianController@editAbout');
Route::post('/musician/setAbout', 'MusicianController@setAbout');
Route::post('/musician/edit/instruments', 'MusicianController@editInstruments');
Route::post('/musician/genres', 'MusicianController@editGenreMusician');
Route::get('/makefanmusician', 'MusicianController@addFanMusician');
//Notification's Routes
Route::get('/notifications/create', 'NotificationController@createnotification');
Route::get('/seen', 'NotificationController@seen');
Route::get('/notifications', 'NotificationController@notifications');
Route::get('/notifications/seen', 'NotificationController@seenNotifications');
//Sponsor's Routes
Route::get('/sponsors/create', 'SponsorController@createsponsor');
//Superadmin's Routes
Route::get('/users/create_superadmin', 'SuperadminController@createsuperadmin');
//Upermission's Routes
Route::get('/upermissions/create', 'UpermissionController@createupermission');
//Video's Routes
Route::get('/videos/create', 'VideoController@createvideo');
Route::post('/videos/create', 'VideoController@creator');
Route::get('/users/fan/addlike', 'VideoController@addLike');
Route::get('/videos/genre', 'VideoController@genre');
Route::get('/videos/genre_reproductor', 'VideoController@genre_reproductor');
Route::get('/videos/delete', 'VideoController@deleteVideo');
Route::get('/videos/verify/youtube', 'VideoController@verifyVideo');
//Wall's Routes
Route::get('/Walls/create', 'WallController@createWall');
//Winner's Routes
Route::get('/winners/create', 'WinnerController@createwinner');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return response(view('errors.404'), 404);
});

//Services Routes

Route::get('homeSliderServices', 'ServicesController@homeSlidersService');
Route::get('sponsorsService', 'ServicesController@takeSponsors');
Route::get('auth/user', 'ServicesController@getauthuser');
Route::get('user/wall', 'ServicesController@getUserWall');
Route::get('band/wall', 'ServicesController@getBandWall');
Route::get('user/wall/follows', 'ServicesController@getFollowersUser');
Route::get('user/check/follows', 'ServicesController@checkFollowersUser');
Route::get('band/wall/follows', 'ServicesController@getfollowingBands');
Route::get('band/check/follows', 'ServicesController@checkfollowingBands');
Route::get('usersService', 'ServicesController@takeUsers');
Route::get('musiciansService', 'ServicesController@takeMusicians');
Route::get('bandsService', 'ServicesController@takeBands');
Route::get('genresService', 'ServicesController@takeGenres');
Route::get('notificationsService', 'ServicesController@notificationsService');
Route::get('userWallService', 'ServicesController@usersWall');
Route::get('bandWallService', 'ServicesController@bandsWall');
Route::get('generalWallService', 'ServicesController@generalWallService');
Route::get('bandsAboutService', 'ServicesController@bandsAbout');
Route::get('musiciansAboutService', 'ServicesController@musiciansAbout');
Route::get('favoritesVideosService', 'ServicesController@favoriteVideos');
Route::get('videosMusicianService', 'ServicesController@videosMusicians');
Route::get('videosService', 'ServicesController@showVideos');
Route::get('rankingService', 'ServicesController@rankingWall');
Route::get('checkVideoService', 'ServicesController@checkVideoType');
Route::get('showartists', 'ServicesController@showArtists');
Route::get('artists_genre', 'ServicesController@artistsByGenre');
Route::get('videos/player', 'ServicesController@videoReproductor');
Route::get('user/follows', 'ServicesController@showFollowErsIng');
Route::get('band/followers', 'ServicesController@showFollowersBands');
Route::get('/emailvalidatormobile', 'ServicesController@emailValidatorService');
Route::get('/logout/mobile', 'ServicesController@logoutMobile');
Route::get('/membersvalidationmobile', 'ServicesController@membersValidatorService');
Route::post('mobile/createcomment', 'ServicesController@textComment');
Route::post('mobile/comment/video', 'ServicesController@commentVideos');
Route::post('mobile/login/app', 'ServicesController@loginService');
Route::post('mobile/register/app', 'ServicesController@registerService');
Route::post('mobile/update/musician', 'ServicesController@musicianUpdateService');
Route::post('mobile/update/fan', 'ServicesController@fanUpdateService');
Route::post('mobile/create/band', 'ServicesController@createBand');
Route::post('mobile/update/background', 'ServicesController@updateBackgroundImg');
Route::post('mobile/upload/pictures', 'ServicesController@upload_picture');
Route::post('mobile/upload/video', 'ServicesController@upload_video');
Route::post('mobile/upload/videoartists', 'ServicesController@videoArtistsUpload');
Route::post('mobile/about/musicians', 'ServicesController@setMusicianAboutService');
Route::post('mobile/about/bands', 'ServicesController@setBandAboutService');
Route::post('mobile/editmusician/role', 'ServicesController@editRoleMusician');
Route::post('mobile/editmusician/genre', 'ServicesController@editGenreMusician');
Route::post('mobile/editband/role', 'ServicesController@editRoleBand');
Route::post('mobile/editband/genre', 'ServicesController@editGenreBand');
Route::post('mobile/band/editmember', 'ServicesController@addmemberService');
Route::get('mobile/notifications/test', 'ServicesController@notifications');
Route::get('check/video/likes', 'ServicesController@checkvideoLikes');
Route::get('check/comment/likes', 'ServicesController@checkCommentLikes');
});