<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Inspections\Spam;

use Illuminate\Foundation\Testing\RefreshDatabase;

class SpamTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_checks_for_invalid_keywords()
    {
        $spam = new Spam();

        $this->assertFalse($spam->detect('Innocent text'));

        $this->withoutExceptionHandling()->expectException(\Exception::class);

        $spam->detect('yahoo customer support');
    }

    /** @test */
    public function it_checks_for_any_key_being_held_down()
    {
        $spam = new Spam();

        $this->withoutExceptionHandling()->expectException(\Exception::class);

        $spam->detect('Hello World aaaaaa');
    }

}
