<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Notifications\NewUserMessage;
use App\Repositories\Messages;
use App\Repositories\Users;

class UsersController extends Controller
{
    protected $user;
    protected $message;

    public function __construct(Users $user, Messages $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function show($id)
    {
        $user = $this->user->with([
            'questions', 'answers', 'followers', 'questionFollowers'
        ])->find($id);

        return view('users.show', compact('user'));
    }

    public function follow($id)
    {
        $follower = auth()->guard('api')->user();
        $following = $this->user->find($id);
        $follow = $follower->followUser($following->id);

        if (count($follow['attached']) > 0) {
            $following->notify(new NewUserFollowNotification());
            $following->increment('followings_count');
            $follower->increment('followers_count');
            $followed = true;
        } else {
            $following->decrement('followings_count');
            $follower->decrement('followers_count');
            $followed = false;
        }

        return compact('followed');
    }
}
