@extends('layouts.app')

@section('content')
<div class="container mt-5"><input type="text" name="q" class="form-control me-2" placeholder="Search friends..." value="{{ request('q') }}">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Welcome, {{ $user->name }}!</h3>
        </div>
        
        <div class="card-body">
            <p class="lead">This is your dashboard. Use the navigation bar to explore.</p>
            
                    

            <a href="{{ route('profile.edit') }}" class="btn btn-success">Manage Profile</a>
            <a href="{{ route('posts.create') }}"" class="btn btn-info">Create Post</a>

            <a href="{{ route('posts.index') }}"" class="btn btn-info">View Posts</a>
        </div>
        <div class="card-footer text-end">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection
