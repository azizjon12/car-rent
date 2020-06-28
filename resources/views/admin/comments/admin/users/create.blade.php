{{-- In this file we will create a Create view for Users  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the page --}}
@section('content')
    <h1>{!! trans('home.Create') !!} a {!! trans('home.User') !!}</h1>

    {{-- Here we call store method of the AdminUsersController which stores all the Users --}}
    {!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true] ) !!}
    
    <div class="row">
        <div class="col-md-6">
            {{-- Name of a User --}}   
            <div class="form-group">
                {!! Form::label('name', Lang::get('home.Name_and_Surname')) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Email of a User --}}
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Address of a User --}}
            <div class="form-group">
                {!! Form::label('address', Lang::get('home.Address')) !!}
                {!! Form::text('address', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Postcode of a User --}}
            <div class="form-group">
                {!! Form::label('postcode', 'Postcode') !!}
                {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
            </div>
            {{-- City of a User --}}
            <div class="form-group">
                {!! Form::label('city', Lang::get('home.City')) !!}
                {!! Form::text('city', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">  
            {{-- Phone number of a User --}} 
            <div class="form-group">
                {!! Form::label('phone', Lang::get('home.Phone')) !!}
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Role of a User --}}
            <div class="form-group">
                {!! Form::label('role_id', Lang::get('home.Role')) !!}
                {!! Form::select('role_id', [''=> 'Choose role'] + $roles, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Photo of a User --}}
            <div class="form-group">
                {!! Form::label('photo_id', Lang::get('home.Photo')) !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Password of a User --}}
            <div class="form-group">
                {!! Form::label('password', Lang::get('home.Password')) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            {{-- Initialising a create button by using pure PHP --}}
            @php($create_user = Lang::get('home.Create') . ' a ' . Lang::get('home.User') )
            <div class="form-group">
                {!! Form::submit($create_user, ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
 
    {{-- Include form-errors file for error checking --}}
    @include('includes.form-errors')
    {!! Form::close() !!}
@endsection