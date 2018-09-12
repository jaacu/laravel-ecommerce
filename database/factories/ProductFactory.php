<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText(),
        'stock' => $faker->numberBetween(1,20),
        'price' => $faker->randomFloat(2,10,1000000),
        'shop_id' => function (){
            return App\Shop::all()->random()->id;
        }
    ];
});
