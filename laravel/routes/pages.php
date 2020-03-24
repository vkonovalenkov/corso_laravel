<?php
//Lezione 188 se la pagina e statica posiimo passare direttamente la vista blade
//Route::get('about','PageController@about');
Route::view('about','about');
Route::get('blog','PageController@blog');
Route::get('staff','PageController@staff');
