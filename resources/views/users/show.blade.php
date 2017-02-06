@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img class="img-thumbnail rounded-circle" width="200" height="200" src="{{ $user->avatar }}" alt="{{ $user->name }}">
                            </div>
                            <div class="col-md-5">
                                <div class="card-block">
                                    <h1 class="card-title">
                                        {{ $user->name }}
                                    </h1>
                                    <h6 class="card-text text-muted">
                                        暂无更多资料
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="card-block">
                                            <h5 class="card-title text-muted">
                                                提问
                                            </h5>
                                            <h2 class="card-text">
                                                {{ $user->questions->count() }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-block">
                                            <h5 class="card-title text-muted">
                                                回答
                                            </h5>
                                            <h2 class="card-text">
                                                {{ $user->answers->count() }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-block">
                                            <h5 class="card-title text-muted">
                                                关注了
                                            </h5>
                                            <h2 class="card-text">
                                                {{ $user->userFollowers->count() }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card-block">
                                            <h5 class="card-title text-muted">
                                                关注者
                                            </h5>
                                            <h2 class="card-text">
                                                {{ $user->userFolloweds->count() }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group"></div>

        <div class="row">
            <div class="col-md-3">
                @if (auth()->check() && auth()->user()->isAuthor($user->id))
                <div class="btn-group-vertical btn-block btn-group-lg" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary">
                        编辑个人资料
                    </button>
                    <button type="button" class="btn btn-secondary">
                        查看私信
                    </button>
                </div>
                @endif
            </div>
            <div class="col-md-9">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#questions" role="tab">提问 ({{ $user->questions->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#answers" role="tab">回答 ({{ $user->answers->count() }})</a>
                    </li>
                    @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#notifications" role="tab">消息 ({{ $user->notifications->count() }})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#follow" role="tab">关注</a>
                    </li>
                    @endif
                </ul>

                <div class="form-group"></div>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active fade show" id="questions" role="tabpanel">
                        @foreach ($user->questions as $question)
                            <div class="card form-group">
                                <div class="card-block">
                                    <h3 class="card-title">
                                        <a href="{{ route('questions.show', $question->id) }}">
                                            {{ $question->title }}
                                        </a>
                                    </h3>
                                    <h6 class="card-text text-muted">
                                        {{ $question->answers_count }} 个回答 / {{ $question->followers_count }} 个关注
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="answers" role="tabpanel">
                        @foreach ($user->answers as $answer)
                            <div class="card form-group">
                                <div class="card-block">
                                    {{ $answer->body }} 回答于 <a href="{{ route('questions.show', $answer->question_id) }}">{{ $answer->question->title }}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (auth()->check())
                    <div class="tab-pane fade" id="notifications" role="tabpanel">
                        @foreach ($user->notifications as $notification)
                            @include('notifications.' . snake_case(class_basename($notification->type)))
                        @endforeach
                    </div>

                    <div class="tab-pane fade" id="follow" role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#question-followers" role="tab">关注的提问 ({{ $user->questionFollowers->count() }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#user-followers" role="tab">我关注的人 ({{ $user->userFollowers->count() }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#user-followeds" role="tab">关注我的人 ({{ $user->userFolloweds->count() }})</a>
                            </li>
                        </ul>

                        <div class="form-group"></div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active fade show" id="question-followers" role="tabpanel">
                                @foreach ($user->questionFollowers as $question)
                                    <div class="card form-group">
                                        <div class="card-block">
                                            <h3 class="card-title">
                                                <a href="{{ route('questions.show', $question->id) }}">
                                                    {{ $question->title }}
                                                </a>
                                            </h3>
                                            <h6 class="card-text text-muted">
                                                {{ $question->answers_count }} 个回答 / {{ $question->followers_count }} 个关注
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="user-followers" role="tabpanel">
                                @foreach ($user->userFollowers as $follower)
                                    <div class="card form-group">
                                        <div class="card-block">
                                            <img width="50" class="img-thumbnail rounded-circle" src="{{ $follower->avatar }}" alt="{{ $follower->name }}">
                                            <a href="{{ route('users.show', $follower->id) }}">
                                                {{ $follower->name }}
                                            </a> 最近活跃于
                                            {{ $follower->updated_at->diffForHumans() }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="user-followeds" role="tabpanel">
                                @foreach ($user->userFolloweds as $followed)
                                    <div class="card form-group">
                                        <div class="card-block">
                                            <img width="50" class="img-thumbnail rounded-circle" src="{{ $followed->avatar }}" alt="{{ $followed->name }}">
                                            <a href="{{ route('users.show', $followed->id) }}">
                                                {{ $followed->name }}
                                            </a> 最近活跃于
                                            {{ $followed->updated_at->diffForHumans() }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
@endsection
