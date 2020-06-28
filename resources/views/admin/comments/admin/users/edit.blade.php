{{-- In this file we will create a view for Editing Users  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    <h1>{!! trans('home.Edit') !!} {!! trans('home.User') !!}</h1>
    {{-- <h1>Edit {{Auth::user()->name}}</h1> --}}
    {{-- <div class="col-md-3">
        <img class="img-responsive img-rounded" src="{{$user->photo ? $user->photo['file'] : 'http://via.placeholder.com/200x200'}}" alt="">
    </div> --}}
    <div class="col-md-9">
        {{-- Here we call update method of the AdminUsersController which 
            is responsible for updating the Users by using a User model --}}
        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true] ) !!}
        {{-- Name of the User --}}
        <div class="form-group">
            {!! Form::label('name', 'Full Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Email of the User --}}
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Address of the User --}}
        <div class="form-group">
            {!! Form::label('address', 'Home Address') !!}
            {!! Form::text('address', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Postcode of the User --}}
        <div class="form-group">
            {!! Form::label('postcode', 'Postcode') !!}
            {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
        </div>
        {{-- City of the User --}}
        <div class="form-group">
            {!! Form::label('city', 'City') !!}
            {!! Form::text('city', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Phone number of the User --}}
        <div class="form-group">
            {!! Form::label('phone', 'Phone') !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Role of the User --}}
        <div class="form-group">
            {!! Form::label('role_id', 'Role') !!}
            {!! Form::select('role_id', [''=> 'Choose role'] + $roles, null, ['class' => 'form-control']) !!}
        </div>
        {{-- Uploading a photo of the User --}}
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo') !!}
            {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Password for the User --}}
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        {{-- Initialising Update and Delete buttons --}}
        @php($update_user = 'Update') 
        @php($delete_user = 'Delete') 
        <div class="form-group">
            {!! Form::submit($update_user, ['class' => 'btn btn-primary']) !!}
        </div>
        @include('includes.form-errors')
        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}
        <div class="form-group">
            {!! Form::submit($delete_user, ['class' => 'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection