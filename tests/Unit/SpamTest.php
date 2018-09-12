<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Spam;

use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_spam()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent text'));
    }
}
