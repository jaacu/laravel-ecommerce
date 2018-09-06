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
