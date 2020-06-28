{{-- In this file we will create a view for Editing and Deleting the Branches  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    <h1>{!! trans('home.Update') !!} {!! trans('home.Branche') !!}</h1>

    {{-- Here we call update method of the CarBranchController which 
        is responsible for updating the Branches by using a Branch model --}}
    {!! Form::model($branch, ['method' => 'PATCH', 'action' => ['CarBranchController@update', $branch->id], 'files'=>true]) !!}
    {{-- Name of the Branch --}}
    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    {{-- Email of the Branch --}}
    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
    {{-- Address of the Branch --}}
    <div class="form-group">
        {!! Form::label('address', Lang::get('home.Address')) !!}
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
    </div>
    {{-- Postcode of the Branch --}}
    <div class="form-group">
        {!! Form::label('postcode', Lang::get('home.Postcode')) !!}
        {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
    </div>
    {{-- Location of the Branch --}}
    <div class="form-group">
        {!! Form::label('location', Lang::get('home.Location')) !!}
        {!! Form::text('location', null, ['class' => 'form-control']) !!}
    </div>
    {{-- Branch's Phone number --}}
    <div class="form-group">
        {!! Form::label('phone', Lang::get('home.Phone')) !!}
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
    {{-- Button for "Update" function --}}
    <div class="form-group">
        {!! Form::submit(Lang::get('home.Update'), ['class' => 'btn btn-primary']) !!}
    </div>

    {{-- Include the form-errors file for error checking --}}
    @include('includes.form-errors')
    {!! Form::close() !!}

    {{-- Here we call destroy method of the CarBranchController which is
            responsible for Deleting the specific Branch --}}
    {!! Form::open(['method' => 'DELETE', 'action' => ['CarBranchController@destroy', $branch->id]]) !!}
    {{-- Button for "Delete" function --}}
    <div class="form-group">
        {!! Form::submit(Lang::get('home.Delete'), ['class' => 'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}
@endsection