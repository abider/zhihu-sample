@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $question->title }}
                </div>

                <div class="panel-body">
                    {{ $question->body }}
                </div>
            </div>

            @foreach ($question->answers as $answer)
                <div class="panel panel-default">
                    <div class="panel-body">
                        {{ $answer->body }}
                    </div>
                    <div class="panel-footer">
                        <img width="40" class="img-circle" src="{{ $answer->user->avatar }}" alt="{{ $answer->user->name }}">
                        {{ $answer->user->name }}
                    </div>
                </div>
            @endforeach

            @if (auth()->check())
                <div class="media">
                    <div class="media-left">
                        <img class="img-circle" width="50" height="50" src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}">
                        <p class="text-center">{{ auth()->user()->name }}</p>
                    </div>

                    <div class="media-body">
                        <form action="{{ route('answers.store', $question->id) }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="" cols="30" rows="5" required></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary pull-right">
                                    {{ lang('Submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert alert-danger" role="alert">
                    <strong>您未登陆！</strong>
                    登陆后可进行回答问题。<a href="{{ route('login') }}">马上登陆</a>
                </div>
            @endif

        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img class="img-circle" width="60" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                            <h3>{{ $question->user->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h3>{{ $question->followers_count }}</h3>
                                    问题关注
                                </div>
                                <div class="col-xs-6">
                                    <h3>{{ $question->answers_count }}</h3>
                                    答案
                                </div>
                            </div>
                        </div>
                        @if (auth()->check())
                            <div class="panel-footer">
                                <question-follow url="{{ route('questions.follow', $question->id) }}" :followed="false"></question-follow>
                            </div>
                        @endif
                    </div>
                </div>

                @if (auth()->check() && auth()->user()->isAuthor($question))
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                操作
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-default btn-block">
                                            {{ lang('Edit Question') }}
                                        </a>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button class="btn btn-danger btn-block">
                                                {{ lang('Delete Question') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ lang('Topic') }}
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach ($question->topics as $topic)
                                <li class="list-group-item">
                                    {{ $topic->name }}
                                    <span class="badge">{{ $topic->questions_count }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
