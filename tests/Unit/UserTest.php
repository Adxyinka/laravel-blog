<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
// use Illuminate\Support\Facades\Facade;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user(): void
    {
        $user = new User([
            'name' => 'Ade',
            'email' => 'Ade@gmail.com',
            'password' => 'Adeyinka1234;',
            'password_confirmation' => 'Adeyinka1234;'
        ]);


        $this->assertTrue(true);
    }

    public function test_article(): void
    {
        $article = new Article([
            'title' => 'test',
            'body' => 'tests'
        ]);


        $this->assertTrue(true);
    }
}
