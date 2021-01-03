<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Thread;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50, 1),
        'body' => $faker->realText(250, 1),
        'user_id' => App\User::inRandomOrder()->first()->id,
        'image' => $faker->image('public/storage/images',640,480, null, false),
    ];
});
