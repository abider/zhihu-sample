<?php

namespace App\Http\Controllers;

use App\Repositories\Answers;
use App\Repositories\Comments;
use App\Repositories\Questions;

class CommentsController extends Controller
{
    protected $comment;
    protected $question;
    protected $answer;

    public function __construct(Comments $comment,
                                Questions $question,
                                Answers $answer)
    {
        $this->comment = $comment;
        $this->question = $question;
        $this->answer = $answer;
    }

    public function questions($id)
    {
        return $this->question
            ->with(['comments', 'comments.user'])
            ->where('id', $id)
            ->first();
    }

    public function answers($id)
    {
        return $this->answer
            ->with('comments', 'comments.user')
            ->where('id', $id)
            ->first();
    }

    public function store()
    {
        $comment = $this->comment->create([
            'user_id' => auth()->guard('api')->user()->id,
            'body' => request('body'),
            'commentable_id' => request('id'),
            'commentable_type' => $this->comment->getModelByType(request('type'))
        ]);

        return $this->comment->with('user')->find($comment->id);
    }
}
