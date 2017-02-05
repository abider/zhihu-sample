@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card form-group">
                <div class="card-block">
                    <h3 class="card-title">
                        {{ $question->title }}
                    </h3>
                    <p class="card-text">
                        {{ $question->body }}
                    </p>
                </div>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card form-group text-center">
                <div class="card-block">
                    <h5 class="text-muted">
                        关注者
                    </h5>
                    <h2>{{ $question->followers_count }}</h2>
                </div>
                @if (auth()->check())
                    <div class="card-footer text-muted">
                        <div class="row">
                            <div class="col-6">
                                <question-follow
                                        url="{{ route('questions.follow', $question->id) }}"
                                        :followed="{!! auth()->user()->isFollowedQuestion($question->id) ? 'true' : 'false' !!}">
                                </question-follow>
                            </div>
                            <div class="col-6">
                                @if (auth()->check())
                                    <button class="btn btn-outline-primary">
                                        写回答
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            @foreach ($question->answers as $answer)
                <div class="card form-group">
                    <div class="card-block">
                        {{ $answer->body }}
                    </div>
                    <div class="card-footer">
                        <img width="40" class="img-thumbnail rounded-circle" src="{{ $answer->user->avatar }}" alt="{{ $answer->user->name }}">
                        {{ $answer->user->name }}
                    </div>
                </div>
            @endforeach

            @if (!auth()->check())
                <div class="alert alert-danger" role="alert">
                    <strong>您未登陆！</strong>
                    登陆后可进行回答问题。<a href="{{ route('login') }}">马上登陆</a>
                </div>
            @endif

        </div>

        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card form-group">
                        <div class="card-header">
                            作者
                        </div>
                        <div class="card-block text-center">
                            <img class="img-thumbnail rounded-circle" width="100" src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}">
                            <h3>{{ $question->user->name }}</h3>
                            <hr>
                            <div class="row">
                                <div class="col-4">
                                    <p class="text-muted">
                                        回答
                                    </p>
                                    <h5>
                                        {{ $question->user->answers_count }}
                                    </h5>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted">
                                        文章
                                    </p>
                                    <h5>
                                        0
                                    </h5>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted">
                                        关注者
                                    </p>
                                    <h5>
                                        {{ $question->user->followings_count }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div class="row">
                                <div class="col-6">
                                    @if (auth()->check())
                                    <user-follow
                                            url="{{ route('users.follow', $question->user_id) }}"
                                            :followed="{!! auth()->user()->isFollowedUser($question->user_id) ? 'true' : 'false' !!}">
                                    </user-follow>
                                    @endif
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-default btn-block">
                                        写私信
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (auth()->check() && auth()->user()->isAuthor($question))
                    <div class="col-md-12">
                        <div class="card form-group">
                            <div class="card-header">
                                操作
                            </div>

                            <div class="card-block">
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
                    <div class="card">
                        <div class="card-header">
                            {{ lang('Topic') }}
                        </div>
                        <div class="card-block">
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
