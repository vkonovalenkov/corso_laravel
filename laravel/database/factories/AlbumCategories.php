<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use LaraCourse\AlbumCategory;
use Faker\Generator as Faker;

$factory->define(AlbumCategory::class, function (Faker $faker) {
    return [
        'category_name'=> $faker->text(16),
        'user_id'=>1
    ];
});
