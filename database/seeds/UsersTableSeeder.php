<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'Javier',
            'email' => 'email@example.com',
            'password' => bcrypt('1234')

        ]);

        $user->assignRole('super-admin');

        factory('App\User', 10)->create();
    }
}
