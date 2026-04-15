<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formRegister()
    {
        $pekerjaans = config('pekerjaan');

        return view('auth.register', compact('pekerjaans'));
    }

    public function register(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);

        Auth::login($user);

        return redirect('/')
            ->with('success', 'Registrasi berhasil, Anda sudah login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->login;

        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : (is_numeric($login) ? 'no_telepon' : 'username');

        $credentials = [
            $field => $login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/')
                ->with('success', 'Login berhasil');
        }

        return back()
            ->withErrors([
                'login' => 'Email / Username / No. Telp atau password salah',
            ])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
