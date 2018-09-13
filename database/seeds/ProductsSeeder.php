<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory('App\Category', 10)->create();
        $tags = factory('App\Tag', 20)->create();
        factory('App\Product', 15)->create()->each(function($product) use ($categories , $tags){
            $product->categories()->attach( $categories->random(3)->pluck('id') );
            $product->tags()->attach( $tags->random(4)->pluck('id') );
        });        
    }
}
