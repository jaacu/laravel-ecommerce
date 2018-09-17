<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->realText(),
        'user_id' => function (){
            $user = factory( App\User::class )->create();
            $user->assignRole('shopkeeper');
            return $user->id;
        }
    ];
});
