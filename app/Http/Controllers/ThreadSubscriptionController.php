<?php

namespace App\Http\Controllers;


use App\Thread;

class ThreadSubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($channelId, Thread $thread)
    {
        $thread->subscribe();
    }
}
