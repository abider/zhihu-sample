<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Question;
use App\Repositories\Questions;

class QuestionsController extends Controller
{
    protected $question;

    public function __construct(Questions $question)
    {
        $this->question = $question;
        $this->middleware('auth', ['expert' => ['index', 'show']]);
    }

    public function index()
    {
        $questions = $this->question->all();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(StoreQuestionRequest $request)
    {
        $question = $this->question->create(
            array_merge(
                $request->toArray(),
                ['user_id' => auth()->id()]
            )
        );
        flash('成功发布问题', 'success');

        return redirect()->route('questions.show', $question);
    }

    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    public function update(StoreQuestionRequest $request, $question)
    {
        $this->question->update($request->toArray(), $question);
        flash('问题修改成功', 'success');

        return redirect()->route('questions.show', $question);
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function destroy($question)
    {
        $this->question->delete($question);
        flash('问题删除成功', 'success');

        return redirect()->route('questions.index');
    }
}
