<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validasi data.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'        => 'required|string|max:255',
            'email'       => 'required|string|email|max:255|unique:users',
            'customerId'  => 'required|string|max:10|min:10|unique:users',
            'address'     => 'required|string|max:255',
            'password'    => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Buat akun baru.
     */
    protected function create(array $data)
    {
        return User::create([
            'name'        => $data['name'],
            'email'       => $data['email'],
            'customerId'  => $data['customerId'],
            'address'     => $data['address'],
            'password'    => bcrypt($data['password']),
            'role'        => 'user',
        ]);
    }

    /**
     * Override agar setelah register tidak langsung login.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
