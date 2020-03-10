<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }

    public function testGuestLike()
    {
        $article = factory(Article::class)->create();

        $response = $this->json('PUT', route('articles.like', ['article' => $article]));

        $response->assertStatus(401);

        $this->assertEquals(0, $article->likes->count());
    }

    public function testAuthLike()
    {
        $user = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $response = $this->actingAs($user)
            ->json('PUT', route('articles.like', ['article' => $article]));

        $response->assertStatus(200)
            ->assertJson([
                'id' => $article->id,
                'countLikes' => $article->count_likes,
            ]);

        $this->assertNotNull($article->likes->where('id', $user->id));
    }
}
