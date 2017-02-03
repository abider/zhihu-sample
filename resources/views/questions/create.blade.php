@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ lang('Create Question') }}</div>

                <div class="panel-body">
                    <form action="{{ route('questions.store') }}" method="post">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">{{ lang('Title') }}</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body">{{ lang('Body') }}</label>
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control" required>
                                {{ old('body') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right">{{ lang('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
