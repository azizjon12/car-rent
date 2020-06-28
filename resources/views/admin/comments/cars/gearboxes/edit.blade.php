{{-- In this file we will create a view for Editing and Deleting the Car Transmission Type  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the Content of the Page --}}
@section('content')
    <div class="col-md-6">
        <h1>{!! trans('home.Update') !!} {!! trans('home.Gearbox') !!}</h1>

        {{-- Here we call update method of the CarGearboxController which is
            responsible for Updating of the Car Transmission Types by using a CarGearbox model --}}
        {!! Form::model($gearbox, ['method' => 'PATCH', 'action' => ['CarGearboxController@update', $gearbox->id], 'files'=>true]) !!}
        {{-- Name of the Transmission Type of the Car --}}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Button for "Update" function --}}
        <div class="form-group">
            {!! Form::submit(Lang::get('home.Update'), ['class' => 'btn btn-primary']) !!}
        </div>

        {{-- Will include the form-errors file for error checking --}}
        @include('includes.form-errors')
        {!! Form::close() !!}

        {{-- Here we call destroy method of the CarGearboxController which is
            responsible for Deleting the specific Transmission type --}}
        {!! Form::open(['method' => 'DELETE', 'action' => ['CarGearboxController@destroy', $gearbox->id]]) !!}
        <div class="form-group">
            {!! Form::submit(Lang::get('home.Delete'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection