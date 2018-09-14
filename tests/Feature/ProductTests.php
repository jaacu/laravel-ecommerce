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

    public function createShopkeeper(){
        $user = factory( User::class )->create();
        $user->assignRole('shopkeeper');
        $shop = factory( Shop::class )->create([ 'user_id' => $user->id ]);
        $user->shop()->save($shop);
        return $user;
    }
    public function createProduct(){
        return $product = factory( Product::class )->create(['shop_id' => $this->createShopkeeper()->shop->id ]);
    }

    public function testcreateProductWorks(){

        $product = $this->createProduct();

        $this->assertInstanceOf( Product::class, $product );
    }

    public function testcreateShopkeeperWorks(){

        $user = $this->createShopkeeper();

        $this->assertInstanceOf( User::class, $user );

        $this->assertTrue( $user->hasRole('shopkeeper') );

        $this->assertInstanceOf( Shop::class , $user->shop );

    }

    public function testProductCreate(){

        $this->removeBadTestingMiddleware();

        $user = $this->createShopkeeper();
        auth()->login($user);

        $data = [
            'name' => 'Testing Name',//$this->faker->title,
            'description' => $this->faker->realText(),
            'stock' => $this->faker->numberBetween(1,20),
            'price' => $this->faker->randomFloat(2,10,1000000),
        ];

        $response = $this->actingAs($user)
                        ->post( route('product.store') , $data);

        $product = Product::all()->last();

        $this->assertDatabaseHas('products', $data);

    }

    public function testProductCreateWithTagsAndCategories(){

        $this->removeBadTestingMiddleware();

        $user = $this->createShopkeeper();
        auth()->login($user);

        $data = [
            'name' => 'Testing Name',//$this->faker->title,
            'description' => $this->faker->realText(),
            'stock' => $this->faker->numberBetween(1,20),
            'price' => $this->faker->randomFloat(2,10,1000000),
            'tags' => 'this,are,test,tags',
            'category' => array_flatten(Category::all()->random(3)->pluck('id')) ,
        ];

        $response = $this->actingAs($user)
                        ->post( route('product.store') , $data);
        $product = Product::all()->last();

        $this->assertDatabaseHas('products', array_except($data , ['tags' , 'category']));
        $this->assertEquals( $data['category'] , array_flatten($product->categories->pluck('id')) );
        $tags = Tag::parseTags($data['tags']);
        $this->assertEquals( $tags , array_flatten($product->tags->pluck('id')) );

    }

    public function testSingleProductShows(){

        $product = $this->createProduct();
        $response = $this->get(route('product.show',$product->id));

        $response->assertStatus(200);

        $response->assertSee($product->name);       

        $response->assertSee($product->price);      

    }

    public function testProductDeletes(){
        
        $this->removeBadTestingMiddleware();

        $product = $this->createProduct();

        $user = $product->getUser();
        
        auth()->login($user);

        $response = $this->actingAs($user)
                        ->delete(route( 'product.destroy' , $product->id) );

        $product = Product::withTrashed()->find($product->id);
        $this->assertTrue($product->trashed());

    }

    public function testProductUpdates(){

        $this->removeBadTestingMiddleware();

        $product = $this->createProduct();

        $user = $product->getUser();

        auth()->login($user);

        $data = [
            'name' => 'newName',
            'description' => $this->faker->realText(),
            'stock' => $product->stock+1,
            'price' => $product->price+100
        ];
        $response = $this->actingAs($user)
                        ->patch( route('product.update', $product->id),$data );

        $product = Product::find($product->id);
        $this->assertInstanceOf( Product::class , $product);

        $this->assertDatabaseHas('products', $data);

        // $this->assertEquals( $data['name'] , $product->name);

        // $this->assertEquals( $data['description'] , $product->description);

        // $this->assertEquals( $data['stock'] , $product->stock);

        // $this->assertEquals( $data['price'] , $product->price);
        
    }
}
