<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{

    public function testArticleCreatedSuccessfully()
    {
        $user  = factory(User::class)->create([
            'name' => "test",
            'email' => "test@test.com",
            'password' => 'password'
        ]);

        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $payload = [
            'title' => "test",
            'body' => "body test"
        ];

        $this->json('POST', 'api/articles', $payload, $headers)
            ->assertStatus(201)
            ->dump()
            ->assertJson([
                'id' => 1,
                'title' => 'test',
                'body' => 'body test'
            ]);
    }

    public function testArticlesAreUpdatedSuccessfully()
    {
        $article = factory(Article::class)->create([
            'title' => 'test',
            'body' => 'test body'
        ]);


        $user  = factory(User::class)->create([
            'name' => "test",
            'email' => "test@test.com",
            'password' => 'password'
        ]);

        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];


        $payload = [
            'title' => "new title",
            'body' => "new body test"
        ];

        $this->json('PUT', "api/articles/" . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'title' => 'new title',
                'body' => 'new body test'
            ]);
    }
}
