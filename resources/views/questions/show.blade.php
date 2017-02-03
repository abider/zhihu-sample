@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $question->title }}
                </div>

                <div class="panel-body">
                    {{ $question->body }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
    </div>
@endsection
