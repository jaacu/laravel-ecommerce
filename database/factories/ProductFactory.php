<?php

use Faker\Generator as Faker;

/**
 * Create the products with dummy data and by default assign the product to a random shop 
 */
$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->realText(),
        'stock' => $faker->numberBetween(1,20),
        'price' => $faker->randomFloat(2,10,10000),
        'shop_id' => function (){
            return App\Shop::all()->random()->id;
        }
    ];
});
