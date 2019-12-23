<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Admin;

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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:writer')->except('logout');
    }

    public function username(){
        return 'username';
    }

    public function AdminLoginForm(){

        return view('auth.login',['url' => 'admin']);
    }

    public function adminLogin(Request $request){
        
        $request->validate([
            'username'=>'required|email',
            'password'=>'required|min:6'
        ]);

        if(Auth::guard('admin')->attempt(['email'=>$request->username,'password'=>$request->password])){
            return redirect('/admin');
        }
        
        return back()->withInput($request->only('username','remember'));
    }

    public function WriterLoginForm(){
        return view('auth.login',['url' => 'writer']);
    }

    public function writerLogin(Request $request){

        $request->validate([
            'username' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(Auth::guard('writer')->attempt(['email'=>$request->username,'password'=>$request->password])){
            return redirect('/writer');
        }
        return back()->withInput($request->only('username','remember'));
    }
}
 