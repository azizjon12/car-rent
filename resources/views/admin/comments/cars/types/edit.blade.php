{{-- In this file we will create a view for Editing and Deleting the Car Types  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    <div class="col-md-6">
        <h1>{!! trans('home.Update') !!} {!! trans('home.Car') !!} {!! trans('home.Type') !!}</h1>
        
        {{-- Here we call update method of the CarTypeController which is
            responsible for Updating of the Car types by using a CarType model --}}
        {!! Form::model($type, ['method' => 'PATCH', 'action' => ['CarTypeController@update', $type->id], 'files'=>true]) !!}
        {{-- Name of the Car Type --}}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Button for the "Update" function --}}
        <div class="form-group">
            {!! Form::submit(Lang::get('home.Update'), ['class' => 'btn btn-primary']) !!}
        </div>

        {{-- We include the form-errors file for error checking --}}
        @include('includes.form-errors')
        {!! Form::close() !!}

        {{-- Here we call destroy method of the CarTypeController which is
            responsible for Deleting the specific Car type --}}
        {!! Form::open(['method' => 'DELETE', 'action' => ['CarTypeController@destroy', $type->id]]) !!}
        {{-- Button for "Delete" function --}}
        <div class="form-group">
            {!! Form::submit(Lang::get('home.Delete'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection