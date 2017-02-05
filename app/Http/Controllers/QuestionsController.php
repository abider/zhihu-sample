<?php

namespace App\Http\Controllers;

use App\Question;
use App\Repositories\Answers;
use App\Repositories\Follows;
use App\Repositories\Topics;
use App\Repositories\Questions;
use App\Http\Requests\StoreQuestionRequest;

class QuestionsController extends Controller
{
    protected $question;
    protected $topic;
    protected $answer;
    protected $follow;

    public function __construct(Questions $question,
                                Topics $topic,
                                Answers $answer,
                                Follows $follow)
    {
        $this->question = $question;
        $this->topic = $topic;
        $this->answer = $answer;
        $this->follow = $follow;
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $questions = $this->question->published()->with('topics')->paginate();

        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = $this->question->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);
        $question->topics()->attach($this->topic->normaleze(request('topics')));

        flash('成功发布问题', 'success');

        return redirect()->route('questions.show', $question);
    }

    public function show($id)
    {
        $question = $this->question->withTopicsById($id);

        return view('questions.show', compact('question'));
    }

    public function edit($id)
    {
        $question = $this->question->withTopicsById($id);

        if (auth()->user()->isAuthor($question)) {
            return view('questions.edit', compact('question'));
        }

        return back();
    }

    public function update(StoreQuestionRequest $request, $question)
    {
        $this->question->update($request->toArray(), $question);

        flash('问题修改成功', 'success');

        return redirect()->route('questions.show', $question);
    }

    public function destroy(Question $question)
    {
        if (auth()->user()->isAuthor($question->user_id)) {
            $this->question->delete($question->id);

            flash('问题删除成功', 'success');
        }

        return redirect()->route('questions.index');
    }

    public function follow($id)
    {
        $follow = auth()->guard('api')->user()->followQuestion($id);
        $question = $this->question->find($id);

        if (count($follow['attached']) > 0) {
            $question->increment('followers_count');
            $followed = true;
        } else {
            $question->decrement('followers_count');
            $followed = false;
        }

        return compact('followed');
    }
}
