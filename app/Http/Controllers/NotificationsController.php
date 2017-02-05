<?php

namespace App\Http\Controllers;

class NotificationsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('notifications.index', compact('user'));
    }
}
