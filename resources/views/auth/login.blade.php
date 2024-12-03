@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg p-4 rounded" style="width: 400px; border-radius: 15px;">
        <h3 class="text-center mb-4 text-primary">Welcome Back</h3>
        <div id="login-alert" class="alert alert-danger d-none text-center" role="alert"></div>
        <form id="login-form">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control border-primary" id="email" placeholder="Enter your email" required>
                <small class="text-danger" id="email-error"></small>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control border-primary" id="password" placeholder="Enter your password" required>
                <small class="text-danger" id="password-error"></small>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill">Login</button>
        </form>
        <p class="mt-4 text-center">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none text-primary">Register</a></p>
    </div>
</div>

<!-- Custom Styling and Animations -->
<style>
    body {
        background: linear-gradient(to bottom right, #e3f2fd, #bbdefb);
        font-family: 'Arial', sans-serif;
    }
    .card {
        background: #ffffff;
        border: none;
        border-radius: 15px;
    }
    .form-control:focus {
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        border-color: #007bff;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    #login-alert {
        margin-bottom: 15px;
    }
    .alert {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#login-form').on('submit', function(event) {
            event.preventDefault();
            $('#email-error').text('');
            $('#password-error').text('');
            $('#login-alert').addClass('d-none').text('');

            $.ajax({
                url: "{{ url('/login') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        window.location.href = "{{ route('dashboard') }}";
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors || {};
                    $('#email-error').text(errors.email || '');
                    $('#password-error').text(errors.password || '');

                    if (xhr.responseJSON.message) {
                        $('#login-alert')
                            .removeClass('d-none')
                            .text(xhr.responseJSON.message);
                    }
                }
            });
        });
    });
</script>
@endsection
