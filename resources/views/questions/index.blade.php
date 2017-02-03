@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">所有问题</div>

                <div class="panel-body">
                    <ul class="list-group">
                        @foreach ($questions as $question)
                            <li class="list-group-item">{{ $question->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
