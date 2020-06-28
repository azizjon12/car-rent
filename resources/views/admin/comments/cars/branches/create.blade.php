{{-- In this file we will create a Create view for Branches  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    <div class="col-md-4">
        <h1>{!! trans('home.Create') !!} {!! trans('home.Branches') !!}</h1>

        {{-- Here we call store method of the CarBranchController which stores all the Branches --}}
        {!! Form::open(['method' => 'POST', 'action' => 'CarBranchController@store']) !!}
        {{-- Name of the Branch --}}
        <div class="form-group">
            {!! Form::label('name', Lang::get('home.Name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Email for the Branch --}}
        <div class="form-group">
            {!! Form::label('email','Email') !!}
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
        {{-- Branch's phone number --}}
        <div class="form-group">
            {!! Form::label('phone', Lang::get('home.Phone')) !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Button for "Create Branch" --}}
        @php($create_branch = Lang::get('home.Create') . ' a ' . Lang::get('home.Branche') )
        <div class="form-group">
            {!! Form::submit($create_branch, ['class' => 'btn btn-primary']) !!}
        </div>
        {{-- We include form-errors file just to check for errors --}}
        @include('includes.form-errors')
        {!! Form::close() !!}
    </div>
@endsection