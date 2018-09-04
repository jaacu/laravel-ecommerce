<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->realText(),
        'user_id' => function (){
            return App\User::role('shopkeeper')->get()->random()->id;
        }
    ];
});
