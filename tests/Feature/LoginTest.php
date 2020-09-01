<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email" => [
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'name' => 'test',
            'email' => 'testlogin@test.com',
            'password' => 'toptal123',
        ]);

        $payload = ['email' => 'testlogin@test.com', 'password' => 'toptal123'];
        $this->json('POST', 'api/login', $payload)
        // $this->post('api/login', $payload, $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

    }
}
