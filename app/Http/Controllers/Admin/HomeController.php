<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\NewRegisterUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('admin.dashboard')->with(compact('users'));
    }

    public function notify()
    {
        $user = User::first();

        // Auth::guard('admin')->user()->notify(new NewRegisterUserNotification($user));
        Notification::send(Auth::guard('admin')->user(), new NewRegisterUserNotification($user));

        return redirect()->back();
    }
}
