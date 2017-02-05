<?php

namespace App\Http\Controllers;

use App\Repositories\Users;

class UsersController extends Controller
{
    protected $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function follow($id)
    {
        $follower = auth()->guard('api')->user();
        $following = $this->user->find($id);
        $follow = $follower->followUser($following->id);

        if (count($follow['attached']) > 0) {
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
