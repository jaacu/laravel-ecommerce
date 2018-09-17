<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Product;
use App\Shop;
use App\User;
use App\Category;
use App\Tag;
class ProductTests extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * Create a a user, assign him the role of shopkeeper and associate him with a shop
     * @return \App\User
     */
    public function createShopkeeper(){
        $user = factory( User::class )->create();
        $user->assignRole('shopkeeper');
        $shop = factory( Shop::class )->create([ 'user_id' => $user->id ]);
        $user->shop()->save($shop);
        return $user;
    }

    /**
     * Create a product and associate it with a new shop
     * @return \App\Product
     */
    public function createProduct(){
        return $product = factory( Product::class )->create(['shop_id' => $this->createShopkeeper()->shop->id ]);
    }

    /**
     * Tests that the createProduct method works and the given product a instance of \App\Product class
     * @return void
     */
    public function testCreateProductWorks(){

        $product = $this->createProduct();

        $this->assertInstanceOf( Product::class, $product );
    }

    /**
     * Tests that the createShopkeeper method works and the user given is a shopkeeper and has a shop
     * @return void
     */
    public function testcreateShopkeeperWorks(){

        $user = $this->createShopkeeper();

        $this->assertInstanceOf( User::class, $user );

        $this->assertTrue( $user->hasRole('shopkeeper') );

        $this->assertInstanceOf( Shop::class , $user->shop );

    }

    /**
     * Tests that a product can be created
     * Make a request to the create product url as a shopkeeper and verify that the product is created 
     * Only with the required data
     * @return void
     */
    public function testProductCreate(){

        $this->removeBadTestingMiddleware();

        //Login the shopkeeper
        $user = $this->createShopkeeper();
        auth()->login($user);

        //Set the dummy data
        $data = [
            'name' => 'Testing Name',//$this->faker->title,
            'description' => $this->faker->realText(),
            'stock' => $this->faker->numberBetween(1,20),
            'price' => $this->faker->randomFloat(2,10,1000000),
        ];

        //Make the request as the shopkeeper with the dummy data
        $response = $this->actingAs($user)
                        ->post( route('product.store') , $data);

        //assert that the product is created
        $this->assertDatabaseHas('products', $data);

    }

    /**
     * Tests that a product can be created
     * Make a request to the create product url as a shopkeeper and verify that the product is created 
     * With additional data like tags and categories
     * @return void
     */
    public function testProductCreateWithTagsAndCategories(){

        $this->removeBadTestingMiddleware();

        //Login the shopkeeper
        $user = $this->createShopkeeper();
        auth()->login($user);

        // Set the dummy data
        $data = [
            'name' => 'Testing Name',//$this->faker->title,
            'description' => $this->faker->realText(),
            'stock' => $this->faker->numberBetween(1,20),
            'price' => $this->faker->randomFloat(2,10,1000000),
            'tags' => 'this,are,test,tags',
            'category' => array_flatten(Category::all()->random(3)->pluck('id')) ,
        ];

        //Make the request as the shopkeeper
        $response = $this->actingAs($user)
                        ->post( route('product.store') , $data);
        $product = Product::all()->last();

        // Assert that the product is in the database and that it has the categories and the tags associated with it
        $this->assertDatabaseHas('products', array_except($data , ['tags' , 'category']));
        $this->assertEquals( $data['category'] , array_flatten($product->categories->pluck('id')) );
        $tags = Tag::parseTags($data['tags']);
        $this->assertEquals( $tags , array_flatten($product->tags->pluck('id')) );

    }

    /**
     * Tests that a single product route and view works
     * @return void
     */
    public function testSingleProductShows(){
        //Create a product and make a request
        $product = $this->createProduct();
        $response = $this->get(route('product.show',$product->id));

        // Assert that the response status is ok
        $response->assertStatus(200);

        // Assert that the view contains the product name and price 
        $response->assertSee($product->name);       

        $response->assertSee($product->price);      
    }

    /**
     * Tests a product can be deleted (Soft delete)
     * Make a requests as the user owning the shop the product belongs to and verify it's deleted
     * @return void
     */
    public function testProductDeletes(){
        
        $this->removeBadTestingMiddleware();

        //Create the product and get the user
        $product = $this->createProduct();

        $user = $product->getUser();
        
        auth()->login($user);

        // Make the request as the user
        $response = $this->actingAs($user)
                        ->delete(route( 'product.destroy' , $product->id) );

        // Assert that the product is deleted (Soft deleted)
        $product = Product::withTrashed()->find($product->id);
        $this->assertTrue($product->trashed());

    }

    /**
     * Tests a product can be updated
     * Make the request as the user owning the shop the product belongs to and verify it's updated
     * @return void
     */
    public function testProductUpdates(){

        $this->removeBadTestingMiddleware();

        // Create the product and the user
        $product = $this->createProduct();

        $user = $product->getUser();

        auth()->login($user);

        // Set the dummy data
        $data = [
            'name' => 'newName',
            'description' => $this->faker->realText(),
            'stock' => $product->stock+1,
            'price' => $product->price+100
        ];

        //Make the request as the user
        $response = $this->actingAs($user)
                        ->patch( route('product.update', $product->id),$data );

        // Assert that the product it's updated in the database
        $product = Product::find($product->id);
        $this->assertInstanceOf( Product::class , $product);

        $this->assertDatabaseHas('products', $data);
        
    }
}
