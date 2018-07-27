<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    protected $filters = ['by', 'popular', 'unanswered'];

    /**
     * Filter query by a given username
     *
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }


    /**
     * Filter the query by most popular threads
     *
     * @return mixed
     */
    protected function popular()
    {
        return $this->builder->orderBy('replies_count', 'desc');
    }

    /**
     *Filter the query by unanswered threads
     *
     * @return mixed
     */
    protected function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }
}