<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Formation;
use Faker\Generator as Faker;

$factory->define(Formation::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph($nbSentences = 3),
        'content' => $faker->paragraph($nbSentences = 10),
        'date' => $faker->dateTimeBetween('+3 days', '+1 years'),
        'user_id' => factory('App\User')->create()
    ];
});
