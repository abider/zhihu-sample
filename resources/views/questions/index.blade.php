@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">所有问题</div>

                <div class="card-block">
                    <ul class="list-group">
                        @foreach ($questions as $question)
                            <li class="list-group-item">
                                <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
