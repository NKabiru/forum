<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function a_user_has_a_profile()
    {
        $user = create('App\User');

        $this->get("/profiles/{$user->name}")
            ->assertSee(e($user->name));
    }

    /** @test */
    public function profiles_display_all_threads_created_by_the_associated_user()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id() ]);

        $this->get("/profiles/" . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

}
