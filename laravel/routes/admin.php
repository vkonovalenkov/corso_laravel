<?php

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
dd(Auth::user()->isAdmin());
    return 'Hello admin';

});
Route::get('/dashboard', function () {

    return 'Admin dashboard';

});

