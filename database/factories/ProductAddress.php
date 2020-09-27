<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence,
        'description'=>$faker->paragraph(5),
        'category_id'=>$faker->numberBetween(1,50),
        'unit'=>$faker->numberBetween(1,187),
        'price'=>$faker->randomFloat(2,10,500),
        'total'=>$faker->numberBetween(2,250),
        'discount'=>$faker->numberBetween(1,100),
    ];
});
