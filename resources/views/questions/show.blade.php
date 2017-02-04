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
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            操作
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-default btn-block">
                                        {{ lang('Edit Question') }}
                                    </a>
                                </div>
                                <div class="col-md-6">
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
