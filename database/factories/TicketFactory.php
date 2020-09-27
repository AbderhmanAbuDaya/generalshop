<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'user_id'=>$faker->numberBetween(1,500),
        'order_id'=>$faker->numberBetween(1,50),
        'title'=>$faker->word,
        'message'=>$faker->paragraph(6),
        'status'=>$faker->randomElement(['panding','watting','close']),
        'ticket_type_id'=>$faker->numberBetween(1,4),
    ];
});
