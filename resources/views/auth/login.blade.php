@extends('auth.app')

@section('content')
<div class="card shadow-lg p-4" style="width: 400px;">
    <h3 class="text-center mb-4">Login</h3>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
        <div class="mt-3 text-center">
            <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account? Register</a>
        </div>
    </form>
</div>
@endsection