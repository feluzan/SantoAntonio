<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Refeicao;
use Faker\Generator as Faker;

$factory->define(Refeicao::class, function (Faker $faker) {

    return [
        'nome' => $faker->word,
        'inicio' => $faker->word,
        'fim' => $faker->word,
        'valor' => $faker->word,
        'habilitada' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
