<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function viewDashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Проверяем логин и пароль
        if ($request->username === 'admin' && $request->password === 'admin') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        // Если данные неверны
        return back()->withErrors(['invalid' => 'Неправильный логин или пароль'])->withInput();
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}
