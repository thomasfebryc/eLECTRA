<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect default setelah login (jika tidak override di authenticated)
     */
    protected $redirectTo = '/home';

    /**
     * Konstruktor
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override method login untuk menambahkan log jika gagal/sukses
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Cek apakah user terlalu banyak gagal login (throttle)
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Coba login
        if ($this->attemptLogin($request)) {
            Log::info('✅ Login berhasil: ' . $request->email);
            return $this->sendLoginResponse($request);
        }

        // Gagal login
        $this->incrementLoginAttempts($request);
        Log::warning('❌ Login gagal: ' . $request->email);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Setelah login sukses, arahkan berdasarkan role
     */
protected function authenticated(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect('/admin');
    }

    return redirect('/home');
}

}
