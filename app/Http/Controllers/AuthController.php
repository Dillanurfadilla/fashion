<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('login');
    }

    public function registerIndex()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard')->with('success', 'Login successful!');
        }
    
        return redirect('login')->with('error', 'Invalid email or password');
    }
    
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->save();

        Auth::login($user);
        return redirect('/')->with('success', 'Registration successful!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
