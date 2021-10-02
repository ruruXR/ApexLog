<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(2,6),
        'category_id' => $faker->numberBetween(1,5),
        'subject' => $faker->realtext(10),
        'message' => $faker->realtext(),
        'name' => $faker->name(),
    ];
});
