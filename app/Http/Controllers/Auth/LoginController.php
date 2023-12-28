<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function login(Request $request)
    {   
        $input = $request->all();
       
        $this->validate($request, [
            'nim_nidn' => 'required|numeric',
            'password' => 'required',
        ]);
       
        if(auth()->attempt(array('nim_nidn' => $input['nim_nidn'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'dosen') {
                return redirect()->route('dosen.home');
            }else if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('m.dashboard');
            }

        }else{
            return redirect()->route('login')
                ->with('error','Kredensial salah, silahkan coba lagi.');
        }
            
    }
}
