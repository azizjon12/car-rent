@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endsection
@section('content')
    <h1>{!! trans('home.Upload') !!} {!! trans('home.Media') !!}</h1>
    {!! Form::open(['method' => 'POST', 'action' => 'AdminMediaController@store', 'class'=>'dropzone']) !!}
    {!! Form::close() !!}
    {{-- <div class="row">
        <div class="form-group">
            {!! Form::label('id', 'Photo') !!}
            {!! Form::file('id', null, ['class' => 'form-control']) !!}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    </div>
        {!! Form::close() !!} --}}
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection
