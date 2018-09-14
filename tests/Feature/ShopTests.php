<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseTransactions;


use App\Shop;
use App\User;

class ShopTests extends TestCase
{
    use DatabaseTransactions;

    public function createShop(){
        return factory( Shop::class )->create();
    }

    public function testCreateShopWorks(){
        $shop = $this->createShop();

        $this->assertInstanceOf( Shop::class , $shop);
    }

    public function testShopDeletes(){
        
        $this->removeBadTestingMiddleware();

        $shop = $this->createShop();

        $user = $shop->user;
        
        auth()->login($user);

        $response = $this->actingAs($user)
                        ->delete(route( 'shop.destroy' , $shop->id) );

        $shop = Shop::withTrashed()->find($shop->id);
        $this->assertTrue($shop->trashed());

    }

    public function testShopUpdates(){

        $this->removeBadTestingMiddleware();

        $shop = $this->createShop();

        $data = [
            'name' => 'This is a valid new shop test name!!!!',
            // 'description' => 'This is a valid new shop test description, a very long test description!!!!'
            'description' => null
        ];

        $user = User::find( $shop->user->id );
        $this->assertNotNull( $user );
        auth()->login($user);

        $response = $this->actingAs( $user )
                        ->patch( route('shop.update' , $shop->id) , $data );

        $this->assertDatabaseHas('shops' , $data);

        $user = User::find( $shop->user->id );
        $shop = Shop::find( $shop->id );
        $this->assertEquals( $shop , $user->shop );
        $this->assertEquals( $shop->name , $data['name']);
        $this->assertNull( $shop->description);
    }

    public function testSingleShopShow(){
        $shop = $this->createShop();
        $response = $this->get(route('shop.show',$shop->id));

        $response->assertStatus(200);

        $response->assertSee($shop->name);       

    }

    public function testShopCreate(){

        $this->removeBadTestingMiddleware();

        $user = factory( User::class )->create();
        $user->assignRole('shopkeeper');
        auth()->login($user);

        $data = [
            'name' => 'This is a valid testName',
            'description' => 'This is a valid long 50 character test description!!!.'
        ];

        $response = $this->actingAs($user)
                        ->post( route('shop.store') , $data);

        // dd($response);
        
        $this->assertDatabaseHas('shops' , $data );

        $shop = Shop::where('name' , $data['name'] )->first();
        $this->assertInstanceOf( Shop::class , $shop);

        $user = User::find( $user->id );

        $this->assertNotNull( $user->shop );

        $this->assertEquals( $shop , $user->shop);
    }
}
