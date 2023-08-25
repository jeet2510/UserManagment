<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminDashboardController extends Controller
{
        public function index()
    {
        $users = User::where('role','user')->get();
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
        if ($user->status == 'active'){
            $user->update(['status' => 'inactive']);
        }else{
            $user->update(['status' => 'active']);
        }
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
    
                if ($user->status == 'active'){
                    $user->update(['status' => 'inactive']);
                }else{
                    $user->update(['status' => 'active']);
                }
            }
            return redirect()->route('users.index')->with('success', 'Users status changed successfully.');
        } elseif ($action === 'bulkDelete') {
            User::whereIn('id', $request->user_ids)->delete();
            return redirect()->route('users.index')->with('success', 'Users deleted successfully.');
        }
        return redirect()->back()->with('success', 'Bulk action completed successfully.');
    }
    
}
