<?php

use LaraCourse\Models\Photo;
use LaraCourse\Models\User;
use LaraCourse\Album;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$cats = [
    'business',
    'animals',
    'city',
    'cats',
    'food',
    'nightlife',
    'fashion',
    'people',
    'sports',
    'nature',
    'technics',
    'transport'
];
$factory->define(LaraCourse\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Album::class, function (Faker $faker) use($cats) {
    return [
        'album_name' => $faker->name,
        'description' => $faker->text(128),
        'user_id' => User::inRandomOrder()->first()->id,
        'album_thumb' =>$faker->imageUrl(640,480,$faker->randomElement($cats))
    ];
});

$factory->define(Photo::class, function (Faker $faker) use($cats) {

    return [
        'album_id' => 1,
        'name' => $faker->text(64),
        'description' => $faker->text(128),
        'image_path' => $faker->imageUrl(640,480,$faker->randomElement($cats))
    ];
});



