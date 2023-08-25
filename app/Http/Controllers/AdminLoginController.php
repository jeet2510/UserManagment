<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/users'; // Change to your admin dashboard route

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['role' => 'admin']);
    }
}
