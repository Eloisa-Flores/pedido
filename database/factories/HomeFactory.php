<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'pedido'=>$faker->pedido,
        'codigo'=>$faker->codigo,
        'descripcion'=>$faker->descripcion,
        'fabrica'=>$faker->fabrica,
        'nota'=>$faker->nota,
        'fecha_pedido'=>$faker->fecha_pedido,
        'empaque'=>$faker->empaque,
         'cantidad_original'=>$faker->cantidad_original,
         'cantidad_recibida'=>$faker->cantidad_recibida,
         'cantidad_pendiente'=>$faker->cantidad_pendiente,
    ];
});
