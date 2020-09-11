<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_create_comment()
    {
        $attributes = [
            'author' => $this->faker->name,
            'text' => $this->faker->text,
        ];

        $responce = $this->get('/comments/create?author='.$attributes['author'].'&text='.$attributes['text']);

        $responce->assertStatus(200);

        $this->assertDatabaseHas('comments', $attributes);

        $this->get('/comments')->assertSee($attributes['author'], $attributes['text'], date("H:i"), date("d.m.Y"));
    }
}
