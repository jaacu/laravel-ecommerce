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

    /**
     * Create a new Shop 
     * @return \App\Shop
     */
    public function createShop(){
        return factory( Shop::class )->create();
    }

    /**
     * Tests that the createShop method works and returns a instance of a shop
     * @return void 
     */
    public function testCreateShopWorks(){
        $shop = $this->createShop();

        $this->assertInstanceOf( Shop::class , $shop);
    }

    /**
     * Test that a shop can be deleted
     * Make a request to delete the shop by the owner of the shop and verify it's deleted (Soft deleted)
     * @return void
     */
    public function testShopDeletes(){
        
        $this->removeBadTestingMiddleware();

        $shop = $this->createShop();

        $user = $shop->user;
        
        auth()->login($user);

        //Make the request acting as the owner of the shop
        $response = $this->actingAs($user)
                        ->delete(route( 'shop.destroy' , $shop->id) );

        //Assert that the shop it's deleted (Soft deleted)
        $shop = Shop::withTrashed()->find($shop->id);
        $this->assertTrue($shop->trashed());

    }

    /**
     * Tests that a shop can be updated
     * Make a request to update the shop as the owner of the shop and verify it's updated
     * @return void
     */
    public function testShopUpdates(){

        $this->removeBadTestingMiddleware();

        $shop = $this->createShop();

        $data = [
            'name' => 'This is a valid new shop test name!!!!',
            // 'description' => 'This is a valid new shop test description, a very long test description!!!!'
            'description' => null //Verify that a null value it's accepted
        ];

        $user = User::find( $shop->user->id );
        $this->assertNotNull( $user ); //Assert that the shop's owner is not null
        auth()->login($user);

        //Make the request as the owner with the test data
        $response = $this->actingAs( $user )
                        ->patch( route('shop.update' , $shop->id) , $data );

        //Assert that the new data is in the database
        $this->assertDatabaseHas('shops' , $data);

        $user = User::find( $shop->user->id );
        $shop = Shop::find( $shop->id );

        //Assert that the the user's shop it's has the updated values
        $this->assertEquals( $shop , $user->shop );
        $this->assertEquals( $shop->name , $data['name']);
        $this->assertNull( $shop->description);
    }

    /**
     * Tests that a single shop route and view works
     * @return void
     */
    public function testSingleShopShow(){

        //Create a new shop and visit it as a guest
        $shop = $this->createShop();
        $response = $this->get(route('shop.show',$shop->id));
        
        //Assert that the response was ok and that the view contains the shop name
        $response->assertStatus(200);

        $response->assertSee($shop->name);       

    }

    /**
     * Tests that a shop can be created
     * Make a request to create a new shop and verifies that it's created
     * @return void
     */
    public function testShopCreate(){

        $this->removeBadTestingMiddleware();

        //Create a user, assign him the shopkeeper role and authenticate him
        $user = factory( User::class )->create();
        $user->assignRole('shopkeeper');
        auth()->login($user);

        $data = [
            'name' => 'This is a valid testName',
            'description' => 'This is a valid long 50 character test description!!!.'
        ];
        //Make the request as the user with the test data
        $response = $this->actingAs($user)
                        ->post( route('shop.store') , $data);
        
        //Assert that the given data is in the database
        $this->assertDatabaseHas('shops' , $data );

        //Assert that the shop with test data can be retrieved
        $shop = Shop::where('name' , $data['name'] )->first();
        $this->assertInstanceOf( Shop::class , $shop);

        $user = User::find( $user->id );
        
        //Assert that the user owns the shop
        $this->assertNotNull( $user->shop );

        $this->assertEquals( $shop , $user->shop);
    }
}
