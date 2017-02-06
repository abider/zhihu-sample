<?php

namespace App\Http\Controllers;

use App\Answer;
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

        return ['result' => true];
    }

    public function vote(Answer $answer)
    {
        $vote = auth()->guard('api')->user()->voteForAnswer($answer->id);

        if (count($vote['attached']) > 0) {
            $answer->increment('votes_count');
            $voted = true;
        } else {
            $answer->decrement('votes_count');
            $voted = false;
        }

        return compact('voted');
    }
}
