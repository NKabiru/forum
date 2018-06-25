<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{

    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();

    }

    /**
     * @test
     */
    public function a_user_can_browse_threads()
    {

        $response = $this->get('/threads')
            ->assertSee($this->thread->title);
    }


    /**
     * @test
     */
    public function a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }


    /**
     * @test
     */
    public function a_user_can_read_replies_associated_with_a_thread()
    {
        $reply = factory(Reply::class)
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id' => $channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create('App\User', [ 'name' => 'JohnDoe']));

        $threadByJohn = create('App\Thread', ['user_id' => auth()->id()]);
        $threadNotByJohn = create('App\Thread');

        $this->get('/threads?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

}
