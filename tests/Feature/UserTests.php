<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;



class UserTests extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;

    public function createUser(){
        return factory(User::class)->create();
    }

    public function testUserCanRegister(){

        $data=[
            'name' => 'TestName',
            'email' => 'testEmail@test.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'rol' => 4 // Client
        ];

        $response = $this->post( route('register') , $data );


        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email']
            ]);
        
        $user = User::where('email', $data['email'])->first();
        
        $this->assertInstanceOf( User::class , $user );

        $this->assertTrue( $user->hasRole('client') );

    }

    public function testUserCanLogin(){
        $user = $this->createUser();
        $response = $this->actingAs($user)
                        ->post( route('login'),['email' => $user->email , 'password' => 'secret']);
        $this->assertAuthenticatedAs($user);
    }

    public function testUserCanLogout(){
        $user = $this->createUser();
        auth()->login($user);
        $response = $this->actingAs($user)
                         ->post( route('logout'));
        $this->assertGuest();
    }
}
