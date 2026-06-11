<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        if (session('user')) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        $user = DB::table('admin')->where('login', $login)->where('haslo', $password)->first();

        if ($user) {
            session(['user' => $user, 'is_admin' => $user->administrator]);
            Log::info('User logged in: ' . json_encode($user));
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Nieprawidłowy login lub hasło.');
        }
    }


    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
