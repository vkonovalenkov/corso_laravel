<?php

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
dd(Auth::user()->isAdmin());
    return 'Hello admin';

});*/
//Route::resource('users','Admin\AdminUserController');
Route::resource('users','Admin\AdminUserController',
    ['names' =>
        [
            'index' => 'user-list'
        ]
    ]
);
Route::get('getUsers','Admin\AdminUserController@getUsers')
->name('admin.getUsers');
Route::view('/','templates/admin')->name('admin');
Route::get('/dashboard', function () {

    return 'Admin dashboard';

});

