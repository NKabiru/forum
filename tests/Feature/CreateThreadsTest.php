<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $this->post('/threads')
            ->assertRedirect('/login');

        $this->get('/threads/create')
            ->assertRedirect('/login');

    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->actingAs(create('App\User'));

        $thread = create('App\Thread');

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
