@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Search Friends</h3>
    <form method="GET" action="{{ route('friends.search') }}">
        <input type="text" name="q" class="form-control" placeholder="Search friends..." value="{{ request('q') }}">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    <div class="results mt-4">
        @forelse ($users as $user)
            <div class="friend">
                <strong>{{ $user->name }}</strong>
                <a href="{{ route('profile.show', $user->id) }}" class="btn btn-link">View Profile</a>
            </div>
        @empty
            <p>No friends found.</p>
        @endforelse
    </div>
</div>
@endsection
