@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Dashboard Card -->
    <div class="card shadow-lg border-0 rounded">
        <!-- Header -->
        <div class="card-header bg-gradient-primary text-white py-4">
            <h3 class="mb-0 text-center">Welcome, {{ $user->name }}!</h3>
        </div>
        <!-- Body -->
        <div class="card-body">
            <!-- Intro Section -->
            <p class="lead text-center mb-4">
                Explore your dashboard to manage your profile, create posts, and connect with friends.
            </p>
            
            <!-- Search Bar -->
            <div class="search-bar mb-4">
            <form action="{{ route('friends.search') }}" method="GET">
    <input type="text" name="q" class="form-control" placeholder="Search friends..." required>
    <button type="submit" class="btn btn-primary mt-2">Search</button>
</form>

            </div>

            <!-- Buttons Section -->
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-success btn-lg rounded-pill shadow-sm">
                    Manage Profile
                </a>
                <a href="{{ route('posts.create') }}" class="btn btn-outline-info btn-lg rounded-pill shadow-sm">
                    Create Post
                </a>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill shadow-sm">
                    View Posts
                </a>
            </div>
        </div>
        <!-- Footer -->
        <div class="card-footer bg-light text-end">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-lg rounded-pill shadow-sm">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection
