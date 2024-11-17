@extends('auth.app')

@section('content')
<div class="card shadow-lg p-4" style="width: 400px;">
    <h3 class="text-center mb-4">Register</h3>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login</a>
        </div>
    </form>
</div>
@endsection