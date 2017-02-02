<?php

namespace App\Http\Controllers;

use App\Repositories\Users;

class EmailController extends Controller
{
    protected $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function confirm($token)
    {
        $user = $this->user->findWhere(['confirmation_token' => $token]);
        $this->user->update([
            'confirmation_token' => str_random(60),
            'is_active' => 1
        ], $user->id);
        auth()->login($user);

        return redirect()->home();
    }
}
