@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User List</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form id="bulkActionForm" method="post" action="{{ route('users.bulk.actions') }}">
        @csrf
        
        <button type="submit" name="action" value="changeStatus" class="btn btn-primary mb-2">Change Selected Status</button>
        
        <button type="submit" name="action" value="bulkDelete" class="btn btn-danger mb-2">Delete Selected</button>
        
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
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
                        <a href="{{ route('users.change.status', $user->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to change status for this user?')">Change Status</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</div>

<script>
    document.getElementById('select-all').addEventListener('click', function () {
        let checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>
@endsection
