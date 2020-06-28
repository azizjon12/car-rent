{{-- In this file we will create a view for Editing and Deleting the Car Fuel Types  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    <div class="col-md-6">
        <h1>{!! trans('home.Update') !!} {!! trans('home.Type_of_fuel') !!}</h1>

        {{-- Here we call update method of the CarFuelController which is
            responsible for Updating of the Fuel Types of the Car by using a CarFuel model --}}
        {!! Form::model($fuel, ['method' => 'PATCH', 'action' => ['CarFuelController@update', $fuel->id], 'files'=>true]) !!}
        {{-- Name of the Fuel Type for the Car --}}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Button for "Update" function --}}
        <div class="form-group">
            {!! Form::submit(Lang::get('home.Update'), ['class' => 'btn btn-primary']) !!}
        </div>
        {{-- We include the form-errors file for error checking --}}
        @include('includes.form-errors')
        {!! Form::close() !!}

        {{-- Here we call destroy method of the CarFuelController which is
            responsible for Deleting the specific Fuel type --}}
        {!! Form::open(['method' => 'DELETE', 'action' => ['CarFuelController@destroy', $fuel->id]]) !!}
        <div class="form-group">
            {!! Form::submit(Lang::get('home.Delete'), ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop