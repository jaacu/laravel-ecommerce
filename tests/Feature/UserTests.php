<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTests extends TestCase
{
    public function createUser(){
        return factory(User::class)->make();
    }

    public function testUserCanLogin(){
        $user = $this->createUser();
        auth()->login($user);
        $this->assertTrue(auth()->check());
    }

    public function testUserCanLogout(){
        $user = $this->createUser();
        auth()->login($user);
        $response = $this->actingAs($user)
                         ->post('/logout');
        $this->assertFalse(auth()->check());
    }
}
