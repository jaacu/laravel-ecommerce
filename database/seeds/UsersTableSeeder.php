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
        /**
         * Create the super-admin user
         */
        $user = App\User::create([
            'name' => 'Javier',
            'email' => 'email@example.com',
            'password' => bcrypt('1234')

        ]);
        
        $user->assignRole('super-admin');

        /**
         * Create the demo shopkeeper
         */
        $user = App\User::create([
            'name' => 'THE Shopkeeper',
            'email' => 'shop@shop.com',
            'password' => bcrypt('1234')

        ]);
        
        $user->assignRole('shopkeeper');
        
        /**
         * Create the demo client
         */
        $user = App\User::create([
            'name' => 'THE client',
            'email' => 'client@client.com',
            'password' => bcrypt('1234')

        ]);
        
        $user->assignRole('client');

        // Create 10 shopkeepers
        factory('App\User', 10)->create()->each(function($u){
            $u->assignRole('shopkeeper');
        });
        // Create 10 clients
        factory('App\User', 10)->create()->each(function($u){
            $u->assignRole('client');
        });
    }
}
