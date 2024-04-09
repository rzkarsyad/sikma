<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Fortify\Http\Responses\LogoutResponse;

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
        ], [
            'nim_nidn.required' => 'Mohon masukkan username.',
            'nim_nidn.numeric' => 'Username harus berupa angka.',
            'password.required' => 'Mohon masukkan kata sandi.',
        ]);

        $credentials = $request->only('nim_nidn', 'password');

        if(auth()->attempt($credentials))
        {
            if (auth()->user()->type == 'dosen') {
                return redirect()->route('dosen.home');
            } else if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('m.dashboard');
            }
        } else {
            $userExists = User::where('nim_nidn', $input['nim_nidn'])->exists();

            if ($userExists) {
                return redirect()->route('login')
                    ->with('error','Kata sandi salah, silahkan coba lagi.');
            } else {
                return redirect()->route('login')
                    ->with('error','Pengguna tidak terdaftar.');
            }
        }
    }

    public function loginAdmin(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'nim_nidn' => 'required',
            'password' => 'required',
        ], [
            'nim_nidn.required' => 'Mohon masukkan username.',
            'password.required' => 'Mohon masukkan kata sandi.',
        ]);

        $credentials = $request->only('nim_nidn', 'password');

        if(auth()->attempt($credentials))
        {
            return redirect()->route('admin.home');
        } else {
            $userExists = User::where('nim_nidn', $input['nim_nidn'])->exists();

            if ($userExists) {
                return redirect()->route('admin.login')
                    ->with('error','Kata sandi salah, silahkan coba lagi.');
            } else {
                return redirect()->route('admin.login')
                    ->with('error','Pengguna tidak terdaftar.');
            }
        }
    }

    public function logout(Request $request) {
        $redirectTo = '/login';

        if (Auth::check() && Auth::user()->type === 'admin') {
            $redirectTo = '/admin/auth';
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($redirectTo);
    }
}
