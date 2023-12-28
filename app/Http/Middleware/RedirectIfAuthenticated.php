<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                $roleId = $user->type;
                switch ($roleId) {
                    case 'mahasiswa':
                        return redirect()->route('m.dashboard');
                    case 'dosen':
                        return redirect()->route('dosen.home');
                    case 'admin':
                        return redirect()->route('admin.home');
                    default:
                        return redirect()->route('login')->with('status', 'Anda tidak memiliki hak akses!');
                }
            }
        }
        return $next($request);
    }
}
