<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Turma;
use Faker\Generator as Faker;

$factory->define(Turma::class, function (Faker $faker) {

    return [
        'nome' => $faker->word,
        'curso' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
