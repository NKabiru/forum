@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div>
                    <h1>
                        {{ $profileUser->name }}
                    </h1>

                    @can('update', $profileUser)
                        <form method="POST" action="{{ route('avatar', $profileUser) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="avatar">
                            <button class="btn btn-primary" type="submit">Add Avatar</button>
                        </form>
                    @endcan

                    <img src="{{ asset('storage/' . $profileUser->avatar_path) }}" width="50" height="50">
                </div>

                <hr>

                @forelse($activities as $date => $activity)
                    <h3>{{ $date }}</h3>
                    <hr>

                    @foreach($activity as $record)
                        @includeIf("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach
                @empty
                    <p>This user has no activity</p>
                @endforelse

            </div>
        </div>
    </div>


@endsection