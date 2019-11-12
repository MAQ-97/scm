<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivationService;

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
    protected $redirectTo = '/client/login';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
//        dd($request);
        $field = 'email';

        $request->merge([$field => $request->input('email')]);

        if (Auth::attempt($request->only($field, 'password'), ($request->input('remember') == 1))) {
            $user = Auth::user();
            return redirect('/users');
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        $username = $this->username();
        $field = 'email';

        $request->merge([$field => $request->input($username)]);

        return $request->only($field, 'password');
    }

    public function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath());
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

}
