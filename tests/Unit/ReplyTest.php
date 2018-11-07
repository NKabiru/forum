<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_has_an_owner()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);
    }

    /** @test */
    public function it_knows_if_it_was_just_published()
    {
        $reply = create('App\Reply');

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at  = now()->subMonth();

        $this->assertFalse($reply->wasJustPublished());
    }

    /** @test */
    public function it_can_detect_all_mentioned_users_in_the_body()
    {
        $reply = create('App\Reply', [
            'body' => '@JaneDoe responds to @JohnDoe'
        ]);

        $this->assertEquals(['JaneDoe', 'JohnDoe'], $reply->mentionedUsers());
    }

}
