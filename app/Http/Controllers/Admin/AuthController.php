<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        // 
    }

    public function loginPage()
    {
        if (Auth::check()) {
            return redirect()->back()->with(['error' => 'You are already registered']);
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $creadential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($creadential)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with(['error' => 'Wrong credential']);
        }
    }
}
