@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($threads as $thread)
                    <div class="card">
                        <div class="card-header">
                            <div class="level">
                                <h4 class="flex">
                                    <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                                </h4>

                                <span><a href="{{ $thread->path() }}"> {{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count ) }}</a></span>
                            </div>
                        </div>
                            <article class="card-body">
                                <div class="body">{{ $thread->body }}</div>
                            </article>
                    </div>
                    <br>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
