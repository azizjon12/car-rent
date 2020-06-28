{{-- In this file we will create a view for User Edit
    where a User can change their details --}}

{{-- Extending a layouts/app view because this file is available for the users --}}
@extends('layouts.app')

{{-- Below is the content of the page --}}
@section('content')
    <div class="container user-information-section">
        <div class="row">
            {{-- Below is the side nav bar for users only --}}
            <div class="col-md-3">
                <ul id="nav-tabs-wrapper" class="nav nav-pills nav-stacked well menu-my-account">
                    <li><a href="{{route('user.user-profile')}}" title="">Account</a></li>
                    <li  class="active"><a href="{{route('user.user-edit')}}" title="">Edit {!! trans('home.Profile') !!}</a></li>
                    <li><a href="{{route('user.user-reservations')}}" title="">{!! trans('home.Reservations') !!}</a></li>
                </ul>
                <br>
                {{-- Link to homepage --}}
                <ul id="nav-tabs-wrapper" class="nav nav-pills nav-stacked well menu-my-account">
                    <li class="rent-now-btn"><a href="{{route('rent-a-car.search-car')}}">{!! trans('home.rent_a_car') !!}</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4">
                        <h1 class="name">{{Auth::user()->name}}</h1>
                        {{-- <img class="img-responsive img-rounded" src="{{Auth::user()->photo ? Auth::user()->photo['file'] : 'http://via.placeholder.com/200x200'}}" alt=""> --}}
                    </div>
                    {{-- <div class="col-md-8">
                        <h1 class="name">{{Auth::user()->name}}</h1>
                        @if(Auth::user()->email)
                            <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{Auth::user()->email}}</p>
                        @endif
                        @if(Auth::user()->phone)
                            <p><i class="fa fa-phone" aria-hidden="true"></i> {{Auth::user()->phone}}</p>
                        @endif
                        @if(Auth::user()->city || Auth::user()->address)
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{Auth::user()->city}}, {{Auth::user()->address}}</p>
                        @endif
                    </div> --}}
                </div>

                {{-- Here we call user_update method of the RentalCarsController which 
                    is responsible for updating a User details --}}
                {!! Form::model($user, ['method' => 'POST', 'action' => ['RentalCarsController@user_update', $user->id], 'id' => 'user_update_form', 'files' => true] ) !!}
                {{-- Form for Name of the User --}}
                <div class="form-group">
                    {!! Form::label('name', 'Full Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                {{-- Form for Email of the User --}}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>
                {{-- Form for Home Address of the User --}}
                <div class="form-group">
                    {!! Form::label('address', 'Home Address') !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
                {{-- Form for Postcode of the User --}}
                <div class="form-group">
                    {!! Form::label('postcode', 'Postcode') !!}
                    {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
                </div>
                {{-- Form for City of the User --}}
                <div class="form-group">
                    {!! Form::label('city', 'City') !!}
                    {!! Form::text('city', null, ['class' => 'form-control']) !!}
                </div>
                {{-- Form for Phone of the User --}}
                <div class="form-group">
                    {!! Form::label('phone', 'Phone Number') !!}
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>
                {{-- <div class="form-group">
                    {!! Form::label('photo_id', 'Photo') !!}
                    {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
                </div> --}}
                {{-- Button for "Confirm"-ation --}}
                <div class="form-group">
                    {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
                </div>

                {{-- Include form-errors files for error checking --}}
                @include('includes.form-errors')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection