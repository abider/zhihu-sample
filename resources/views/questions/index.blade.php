@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card form-group">
                <div class="card-block">
                    <h4>最新提问</h4>
                </div>
            </div>
            @foreach ($questions as $question)
                <div class="card form-group">
                    <div class="card-block">
                        <a href="{{ route('questions.show', $question->id) }}"><h4 class="card-title">{{ $question->title }}</h4></a>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{ $question->answers()->count() }} 个回答 / {{ $question->comments()->count() }} 条评论
                        </h6>
                    </div>
                    <div class="card-footer">
                        <img class="img-thumbnail rounded-circle" width="30" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                        <a class="card-link" href="{{ route('users.show', $question->user->id) }}">{{ $question->user->name }}</a> 提问于 {{ $question->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
            {{ $questions->links('vendor.pagination.bootstrap-4') }}
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card form-group">
                        <div class="card-block">
                            <h4>最新回答</h4>
                        </div>
                    </div>
                    @foreach ($answers as $answer)
                        <div class="card form-group">
                            <div class="card-block">
                                <h6 class="card-title">
                                    {{ $answer->body }}
                                </h6>
                            </div>
                            <div class="card-footer">
                                <img width="30" class="rounded-circle" src="{{ $answer->user->avatar }}" alt="{{ $answer->user->name }}">
                                {{ $answer->user->name }} 回答于 <a href="{{ route('questions.show', $answer->question_id) }}">{{ $answer->question->title }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
