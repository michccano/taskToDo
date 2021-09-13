<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }

    public function login_post(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->input('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            Task::onlyTrashed()->where('deleted_at', '<', Carbon::now()->subDays(30))->forceDelete();
            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors(['invalid' => 'The email or password is wrong.'])
            ->withInput($request->only('email', 'remember'));
    }

    public function register_post(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ], [
            'name.required' => 'Name is required',
            'password.required' => 'Password is required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
