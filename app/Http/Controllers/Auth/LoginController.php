<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

/**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'name' => 'required|max:20',
            'password' => 'required|max:20',
        ]);

        // if(User::where('code',$request->code)->count()==0){
        //     $u =new   User();
        //     $u->code=$request->code;
        //     $u->name='自動登録:'.$request->code;
        //     $u->sexKbn=1;
        //     $u->birthday=date('Y/m/d');
        //     $u->password=Hash::make($request->password);
        //     $u->authKbn=0;
        //     $u->save();
        // }

        if (Auth::attempt($credentials)) {
           $request->session() ->regenerate();
            return response()->json(['token'=>$request->session()->token()]);
        }

        return response()->json( [
            'message' => 'ログイン情報正しくない。',
        ],401);
    }

}
