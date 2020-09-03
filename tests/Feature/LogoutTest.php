<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LogoutTest extends TestCase
{

    public function testUserIsLogedOutSuccessfully(){
        $user = factory(User::class)->create([
            'name' => "test",
            'email' => "test@test.com",
            'password' => 'password']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('GET', 'api/articles', [], $headers)->assertStatus(200);
        $this->json('POST', 'api/logout', [], $headers)->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);

    }
}
