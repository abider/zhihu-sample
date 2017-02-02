<?php

namespace App\Http\Controllers;

use App\User;

class EmailController extends Controller
{
    public function confirm($token)
    {
        $user = User::where('confirmation_token', $token)->first();
        $user->confirmation_token = str_random(60);
        $user->is_active = 1;
        $user->save();
        auth()->login($user);

        return redirect()->home();
    }
}
