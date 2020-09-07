<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Subcategory;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
      'name' => $faker->sentence($nbWords = 3),
      'photo' => 'backend/categoryimg/' . $faker->image('public/backend/categoryimg',400,300, null, false),
    ];
});

$factory->define(Subcategory::class, function (Faker $faker) {
    return [
      'name' => $faker->sentence($nbWords = 3),
    ];
});