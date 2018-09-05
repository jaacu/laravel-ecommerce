<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Product;
use App\Shop;
use App\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;


class ProductTests extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function getRandomProduct(){ return Product::all()->random(); }
    
    public function getRandomShopkeeper(){
        do{
         $user =  User::Role('shopkeeper')->get()->random();
        }while( is_null($user->shop) );
        return $user;
    }


    public function testGetRandomProductWorks(){

        $product = $this->getRandomProduct();

        $this->assertInstanceOf( Product::class, $product );
    }

    public function testGetRandomShopkeeperWorks(){

        $user = $this->getRandomShopkeeper();

        $this->assertInstanceOf( User::class, $user );

        $this->assertTrue( $user->hasRole('shopkeeper') );

        $this->assertInstanceOf( Shop::class , $user->shop );


    }

    public function testProductCreate(){

        $this->removeBadTestingMiddleware();

        $user = $this->getRandomShopkeeper();
        auth()->login($user);

        $data = [
            'name' => 'Testing Name',//$this->faker->title,
            'description' => $this->faker->realText(),
            'stock' => $this->faker->numberBetween(1,20),
            'price' => $this->faker->randomFloat(2,10,1000000),
            'shop_id' => $user->shop->id
        ];

        $response = $this->actingAs($user)
                        ->post( route('product.store') , $data);

        $product = Product::all()->last();

        $this->assertDatabaseHas('products', $data);

    }

    public function testSingleProductShows(){

        $product = $this->getRandomProduct();
        $response = $this->get(route('product.show',$product->id));

        $response->assertStatus(200);

        $response->assertSee($product->name);       

        $response->assertSee($product->price);      

    }

    public function testProductDeletes(){
        
        $this->removeBadTestingMiddleware();

        $product = $this->getRandomProduct();

        $user = $product->getUser();
        
        auth()->login($user);

        $response = $this->actingAs($user)
                        ->delete(route( 'product.destroy' , $product->id) );

        $product = Product::withTrashed()->find($product->id);
        $this->assertTrue($product->trashed());

    }

    public function testProductUpdates(){

        $this->removeBadTestingMiddleware();

        $product = $this->getRandomProduct();

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

        $this->assertEquals( $data['name'] , $product->name);

        $this->assertEquals( $data['description'] , $product->description);

        $this->assertEquals( $data['stock'] , $product->stock);

        $this->assertEquals( $data['price'] , $product->price);
        
    }
}
