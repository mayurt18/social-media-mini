@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg p-4 rounded" style="width: 400px; border-radius: 15px;">
        <h3 class="text-center mb-4 text-success">Create Your Account</h3>
        <div id="register-alert" class="alert alert-danger d-none text-center" role="alert"></div>
        <form id="register-form">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control border-success" id="name" placeholder="Enter your full name" required>
                <small class="text-danger" id="name-error"></small>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control border-success" id="email" placeholder="Enter your email" required>
                <small class="text-danger" id="email-error"></small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control border-success" id="password" placeholder="Enter a strong password" required>
                <small class="text-danger" id="password-error"></small>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control border-success" id="password_confirmation" placeholder="Re-enter your password" required>
                <small class="text-danger" id="password_confirmation-error"></small>
            </div>
            <button type="submit" class="btn btn-success w-100 py-2 rounded-pill">Register</button>
        </form>
        <p class="mt-4 text-center">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none text-success">Login</a></p>
    </div>
</div>

<!-- Custom Styling -->
<style>
    body {
        background: linear-gradient(to bottom right, #e8f5e9, #c8e6c9);
        font-family: 'Arial', sans-serif;
    }
    .card {
        background: #ffffff;
        border: none;
        border-radius: 15px;
    }
    .form-control:focus {
        box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
        border-color: #4caf50;
    }
    .btn-success {
        background-color: #4caf50;
        border: none;
    }
    .btn-success:hover {
        background-color: #388e3c;
    }
</style>

<script>
    $(document).ready(function() {
        $('#register-form').on('submit', function(event) {
            event.preventDefault();
            $('#name-error, #email-error, #password-error, #password_confirmation-error').text('');
            $('#register-alert').addClass('d-none').text('');

            $.ajax({
                url: "{{ url('/register') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        window.location.href = "{{ route('dashboard') }}";
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors || {};
                    $('#name-error').text(errors.name || '');
                    $('#email-error').text(errors.email || '');
                    $('#password-error').text(errors.password || '');
                    $('#password_confirmation-error').text(errors.password_confirmation || '');

                    if (xhr.responseJSON.message) {
                        $('#register-alert')
                            .removeClass('d-none')
                            .text(xhr.responseJSON.message);
                    }
                }
            });
        });
    });
</script>
@endsection
