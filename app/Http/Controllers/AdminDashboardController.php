<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'id'); 
        $users = User::orderBy($sort)
                ->where('role', 'user')
                ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['role' => $request->role]);
        return redirect()->route('users.index')->with('success', 'User role updated successfully.');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => $user->status === 'active' ? 'inactive' : 'active']);
        return redirect()->route('users.index')->with('success', 'User status changed successfully.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function bulkActions(Request $request)
    {
        $action = $request->input('action');

        if ($action === 'changeStatus') {
            foreach ($request->user_ids as $userId) {
                $user = User::findOrFail($userId);
                $user->update(['status' => $user->status === 'active' ? 'inactive' : 'active']);
            }
            return redirect()->route('users.index')->with('success', 'Users status changed successfully.');
        } elseif ($action === 'bulkDelete') {
            User::whereIn('id', $request->user_ids)->delete();
            return redirect()->route('users.index')->with('success', 'Users deleted successfully.');
        } elseif ($action === 'searchUser') {
            $search = $request->input('search');
            $users = User::where('name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->paginate(10); 
            return view('users.index', compact('users'));
        }
        return redirect()->back()->with('success', 'Bulk action completed successfully.');
    }
}
