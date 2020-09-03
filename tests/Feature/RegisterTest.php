<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testUserRegistersSuccessfully()
    {
        $payload = [
            'name' => 'mustadev',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this->json('POST', 'api/register', $payload)
        ->assertStatus(201)
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

    public function testRequirePasswordConfirmation()
    {
        $payload = [
            'name' => "test",
            'email' => "test@test.com",
            'password' => "password"
        ];

        $this->json('POST', 'api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message' => "The given data was invalid.",
                'errors' => [
                    'password' => [ "The password confirmation does not match." ]
                ]
            ]);
    }
}
