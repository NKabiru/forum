@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <div>
                    <h1>
                        {{ $profileUser->name }}
                    </h1>
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