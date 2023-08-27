@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User List</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form id="bulkActionForm" method="post" action="{{ route('users.bulk.actions') }}">
        @csrf
        
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by name or email">
            <button type="submit" name="action" value="searchUser" class="btn btn-primary">Search</button>
        </div>
        
        <button type="submit" name="action" value="changeStatus" class="btn btn-primary mb-2">Change Selected Status</button>
        
        <button type="submit" name="action" value="bulkDelete" class="btn btn-danger mb-2">Delete Selected</button>
        
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        <svg width="16px" height="16px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9.5 8L9.5 16M9.5 16L7 13.25M9.5 16L12 13.25" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14.5 16L14.5 8M14.5 8L12 10.75M14.5 8L17 10.75" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                        <a href="{{ route('users.index', ['sort' => 'name']) }}">Name
                        </a></th>
                        <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
<tr>
            <td><input type="checkbox" name="user_ids[]" value="{{ $user->id }}"></td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
            <td>
                <a href="{{ route('users.destroy', ['id' => $user->id, '_method' => 'DELETE']) }}"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                
                <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                
                <a href="{{ route('users.change.status', $user->id) }}" class="btn btn-success btn-sm"
                    onclick="return confirm('Are you sure you want to change status for this user?')">Change Status</a>
            </td>
</tr>
@endforeach
            </tbody>
        </table>
    </form>
    
    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>
@endsection
