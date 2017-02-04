<?php

namespace App\Http\Controllers;

use App\Repositories\Answers;

class AnswersController extends Controller
{
    protected $answer;

    public function __construct(Answers $answer)
    {
        $this->answer = $answer;
    }

    public function store($question)
    {
        $this->answer->create(request()->toArray());

        flash('感谢您的回答！', 'success');

        return back();
    }
}
