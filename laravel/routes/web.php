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

use Doctrine\DBAL\Driver\IBMDB2\DB2Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use LaraCourse\Album;
use LaraCourse\Http\Controllers\AlbumsController;
use LaraCourse\Http\Controllers\PhotosController;
use LaraCourse\Mail\TestEmail;
use LaraCourse\Mail\TestMd;
use LaraCourse\Models\Photo;
use LaraCourse\Models\User;

Route::get('allalbums',function (){
    $albums = Album::get();
    $albums->dump();
    $albums->pluck('album_name')->dd();
    //$album = Album::get()->pluck('album_name')->dump();
    //return Album::get();
});

//Route::get('/','HomeController@index');

Route::get('welcome/{name?}/{lastname?}/{age?}', 'WelcomeController@welcome')
    /*
    ->where('name','[a-zA-Z]+')
    ->where('lastname','[a-zA-Z]+')
    */
    ->where([
        'name'=>'[a-zA-Z]+',
        'lastname'=>'[a-zA-Z]+',
        'age'=>'[0-9]{0,3}'
    ])
;


//ALBUMS
Route::group(
    [
        //'middleware'=>'auth',
        'middleware'=>['auth','verified'],
        'prefix'=>'dashboard'
    ],
    function (){

        Route::post('/','AlbumsController@index')->name('albums');
        Route::get('/','AlbumsController@index')->name('albums');
        //Route::get('/home','AlbumsController@index')->name('albums');
        Route::post('/home','AlbumsController@index')->name('albums');

        //Route::get('/albums','AlbumsController@index')->name('albums')->middleware('auth');
        Route::get('/albums','AlbumsController@index')->name('albums');
        Route::delete('/albums/{album}','AlbumsController@delete')
            ->name('album.delete')
            ->where('album','[0-9]+');
        //Route::get('/albums/{id}','AlbumsController@show_album')->where('id','[0-9]+');
        //Route::get('/albums/{album}','AlbumsController@show')->where('id','[0-9]+')->middleware('can:view,album');

        Route::get('/albums/create','AlbumsController@create')->name('album.create');

        Route::get('/albums/{id}/edit','AlbumsController@edit')->where('id','[0-9]+')->name('album.edit');

        Route::patch('/albums/{id}','AlbumsController@store')->name('album.patch');

        Route::post('/albums','AlbumsController@save')
            ->name('album.save');

        Route::get('/albums/{album}/images','AlbumsController@getImages')
            ->name('album.getimages')
            ->where('album','[0-9]+');

        /*
         *
         */
        Route::get('/photos',function (){
            return Photo::all();

        });
        Route::get('/users',function (){
            return User::all();

        });
        Route::get('usernoalbums', function (){
            $usernoalbum = DB::table('users as u')
                ->leftJoin('albums as a','u.id','a.user_id')
                ->select('u.id','email','name','album_name')
                //->whereNull('album_name')
                ->whereRaw('album_name is null')
                ->get();

            $usernoalbum = DB::table('users as u')
                ->select('u.id','email','name')
                //->whereNull('album_name')
                ->whereRaw('NOT EXISTS (SELECT user_id,album_name FROM albums  where user_id = u.id)')
                ->get();

            return $usernoalbum;
        });
        //images
        Route::resource('photos', 'PhotosController');
        Route::resource('categories','AlbumCategoryController');
    }

);
//GALLERY
Route::group(
    [
        'prefix'=>'gallery'
    ],
    function (){

        Route::get('albums','GalleryController@index')->name('gallery.albums');
        Route::get('albums/category/{category}','GalleryController@showAlbumsByCategory')->name('gallery.album.category');
        Route::get('/','GalleryController@index')->name('gallery.albums');
        Route::get('album/{album}/images','GalleryController@showAlbumImages')->name('gallery.album.images');

    }
);

//Lezione 193
//Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/','GalleryController@index');
//Lezione 188
//Route::get('home','GalleryController@index');
Route::redirect('home','/');

Route::get('testMail',function (){
    $user = User::get()->first();
    //\Mail::send(new TestEmail(Auth::user()));
    //\Mail::to('v.konovalenkov@gmail.com')->send(new TestEmail($user));
    \Mail::to('v.konovalenkov@gmail.com')->send(new TestMd($user));
});
//Route::view('testMail','mails.testemail',['username'=>'Vladimiro']);
Route::get('testEvent',function (){
    $album = Album::first();
    event(new \LaraCourse\Events\NewAlbumCreated($album));
});


