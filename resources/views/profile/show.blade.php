<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h2>{{ $user->name }}'s Profile</h2>
            </div>
            <div class="card-body">
                <!-- Profile Picture Section -->
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : 'https://via.placeholder.com/150' }}" 
                         alt="Profile Picture" 
                         class="rounded-circle" 
                         width="150" 
                         height="150">
                </div>

                <!-- Profile Details -->
                <div class="text-center">
                    <h5><strong>Email:</strong> {{ $user->email }}</h5>
                    <h5><strong>Bio:</strong> {{ $user->bio ?? 'No bio provided' }}</h5>
                </div>

                <!-- Friends Section -->
                <div class="mt-4">
                    <h4>Friends</h4>
                    <ul class="list-group">
                        @forelse($user->friends as $friend)
                            <li class="list-group-item">
                                <a href="{{ route('profile.show', $friend->id) }}">{{ $friend->name }}</a>
                            </li>
                        @empty
                            <li class="list-group-item">No friends added yet.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                    <a href="{{ route('posts.index') }}" class="btn btn-info">View Posts</a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-warning">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
