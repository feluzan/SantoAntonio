<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Auxilio;
use Faker\Generator as Faker;

$factory->define(Auxilio::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'refeicao_id' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
