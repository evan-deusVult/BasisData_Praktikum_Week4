@extends('admin.layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="container" style="max-width:400px;">
    <h2 class="mb-4">Login Admin</h2>
    <form method="POST" action="{{ route('admin.login.do') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection
