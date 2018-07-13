@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>
                {{ $profileUser->name }}
                <small class="text-muted">Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        <hr>

        @forelse($threads as $thread)
            <div class="card">
                <div class="card-header">
                    <div class="level">
                        <span class="flex">
                             <a href="#">{{ $thread->creator->name }}</a> posted:
                            {{ $thread->title }}
                        </span>
                        {{ $thread->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <br>
        @empty
            <div class="card">
                <div class="card-header">This user has no threads</div>
            </div>
        @endforelse

        {{ $threads->links() }}

    </div>


@endsection