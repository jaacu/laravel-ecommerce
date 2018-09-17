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

    /**
     * Create a user with dummy data
     * @return \App\User
     */
    public function createUser(){
        return factory(User::class)->create();
    }

    /**
     * Tests a user can be registered
     * Make the request with tests values as a guest and verify the user is created
     * @return void
     */
    public function testUserCanRegister(){

        //Set the test data
        $data=[
            'name' => 'TestName',
            'email' => 'testEmail@test.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'rol' => 4 // Client
        ];

        //Make the request as a guest with the test data
        $response = $this->post( route('register') , $data );

        // Assert that the user with the test data is created
        $this->assertDatabaseHas('users', array_only( $data, [ 'name' , 'email' ]));

        // Verify that the user can be retrieved and has the client role
        $user = User::where('email', $data['email'])->first();
        
        $this->assertInstanceOf( User::class , $user );

        $this->assertTrue( $user->hasRole('client') );

    }

    /**
     * Tests a user can login
     * Make the request with tests data and verify the user is authenticated
     * @return void
     */
    public function testUserCanLogin(){
        //Create a user
        $user = $this->createUser();

        //Make the requests with the user data
        $response = $this->actingAs($user)
                        ->post( route('login'),['email' => $user->email , 'password' => 'secret']);

        // Assert that the user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Tests a user can logout
     * Make a request as a authenticated user and assert it's no longer login
     * @return void
     */
    public function testUserCanLogout(){
        //Create and login the user
        $user = $this->createUser();
        auth()->login($user);

        //Make the request as the user
        $response = $this->actingAs($user)
                         ->post( route('logout'));

        //Assert that the user is logout
        $this->assertGuest();
    }
}
