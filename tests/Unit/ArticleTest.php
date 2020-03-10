<?php

namespace Tests\Unit;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function testIsLikedByNobody()
    {
        $article = factory(Article::class)->create();

        $result = $article->isLikedBy(null);

        $this->assertFalse($result);
    }

    public function testIsLikedByTheOne()
    {
        $article = factory(Article::class)->create();

        $user = factory(User::class)->create();

        $article->likes()->attach($user);

        $result = $article->isLikedBy($user);

        $this->assertTrue($result);
    }

    public function testIsLikedByAnother()
    {
        $article = factory(Article::class)->create();

        $user = factory(User::class)->create();

        $another = factory(User::class)->create();

        $article->likes()->attach($another);

        $result = $article->isLikedBy($user);

        $this->assertFalse($result);
    }
}
