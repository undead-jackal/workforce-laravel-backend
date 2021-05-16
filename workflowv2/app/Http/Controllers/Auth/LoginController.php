<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Credentials;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function handleLogin(Request $request)
    {
        if(Auth::attempt(array('username' => $request->username['val'], 'password' => $request->password['val'], 'type' => $request->type['val']))){
            $user= Auth::user();
            $username = $user->name;
            return response()->json([
                'status'  => true,
                'user' => $request->username['val'],
            ]);
        } else {
            return response()->json([
                'status' => false,
                'user'   => []
            ]);
        }
    }
}
