<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PermissaoAcesso;
use Faker\Generator as Faker;

$factory->define(PermissaoAcesso::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'codigo' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
