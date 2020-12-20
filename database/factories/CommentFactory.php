<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->realText(250, 1),
        'thread_id' => App\Thread::inRandomOrder()->first()->id,
    ];
});
