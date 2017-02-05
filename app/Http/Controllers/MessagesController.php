<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserMessage;
use App\Repositories\Messages;
use App\User;

class MessagesController extends Controller
{
    protected $message;

    public function __construct(Messages $message)
    {
        $this->message = $message;
    }

    public function send(User $user)
    {
        $this->message->create([
            'from_user_id' => auth()->guard('api')->user()->id,
            'to_user_id' => $user->id,
            'body' => request('body')
        ]);

        $user->notify(new NewUserMessage());

        return ['result' => true];
    }
}
