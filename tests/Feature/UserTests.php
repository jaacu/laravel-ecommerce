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

    public function getRandomUser(){ return User::all()->random(); }

    public function testUserCanLogin(){
        $user = $this->getRandomUser();
        $response = $this->actingAs($user)
                        ->post( route('login'),['email' => $user->email , 'password' => 'secret']);
        $this->assertAuthenticatedAs($user);
    }

    public function testUserCanLogout(){
        $user = $this->getRandomUser();
        auth()->login($user);
        $response = $this->actingAs($user)
                         ->post( route('logout'));
        $this->assertGuest();
    }
}
