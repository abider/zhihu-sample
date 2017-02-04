<?php

namespace App\Http\Controllers;

use App\Repositories\Topics;
use App\Repositories\Questions;
use App\Http\Requests\StoreQuestionRequest;

class QuestionsController extends Controller
{
    protected $question;
    protected $topic;

    public function __construct(Questions $question, Topics $topic)
    {
        $this->question = $question;
        $this->topic = $topic;
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $questions = $this->question->with('topics')->paginate();

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

    public function destroy($question)
    {
        $this->question->delete($question);

        flash('问题删除成功', 'success');

        return redirect()->route('questions.index');
    }
}
