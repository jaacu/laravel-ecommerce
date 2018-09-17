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
        //Create 10 categories
        $categories = factory('App\Category', 10)->create();
        //Create 20 tags
        $tags = factory('App\Tag', 20)->create();
        /**
         * Create 30 products and to them random tags and categories
         */
        factory('App\Product', 30)->create()->each(function($product) use ($categories , $tags){
            $product->categories()->attach( $categories->random(3)->pluck('id') );
            $product->tags()->attach( $tags->random(4)->pluck('id') );
        });        
    }
}
