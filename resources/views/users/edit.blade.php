@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form method="post" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        
        <!-- Add more fields here as needed -->
        
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
