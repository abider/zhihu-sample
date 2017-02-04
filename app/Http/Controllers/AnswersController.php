<?php

namespace App\Http\Controllers;

use App\Question;
use App\Repositories\Answers;
use App\Repositories\Questions;

class AnswersController extends Controller
{
    protected $answer;
    protected $question;

    public function __construct(Answers $answer, Questions $question)
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    public function store(Question $question)
    {
        $this->answer->create([
            'user_id' => auth()->id(),
            'question_id' => $question->id,
            'body' => request('body')
        ]);

        $question->increment('answers_count');

        flash('感谢您的回答！', 'success');

        return back();
    }
}
