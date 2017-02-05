@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">消息通知</div>

                    <div class="card-block">
                        <ul class="list-group">
                            @foreach ($user->notifications as $notification)
                                @include('notifications.' . snake_case(class_basename($notification->type)))
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
