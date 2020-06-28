{{-- In this file we will create a view for User Profile
    where a User can view their details --}}

{{-- Extending a layouts/app view because this file is available for the users --}}
@extends('layouts.app')

{{-- Below is the content of the page --}}
@section('content')
    <div class="container user-information-section">
        <div class="row">
            {{-- Below is the side nav bar for users only --}}
            <div class="col-md-3">
                <ul id="nav-tabs-wrapper" class="nav nav-pills nav-stacked well menu-my-account">
                    <li class="active"><a href="{{route('user.user-profile')}}" title="">Account</a></li>
                    <li><a href="{{route('user.user-edit')}}" title="">Edit {!! trans('home.Profile') !!}</a></li>
                    <li><a href="{{route('user.user-reservations')}}" title="">{!! trans('home.Reservations') !!}</a></li>
                </ul>
                <br>
                {{-- Link to homepage --}}
                <ul id="nav-tabs-wrapper" class="nav nav-pills nav-stacked well menu-my-account">
                    <li class="rent-now-btn"><a href="{{route('rent-a-car.search-car')}}">{!! trans('home.rent_a_car') !!}</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                {{-- Displaying the following details of the User from our Database --}}
                <div class="col-md-4">
                    {{-- Checking for authenticated user and showing their name --}}
                    <h1 class="name">{{Auth::user()->name}}</h1>
                    {{-- Email of the User --}}
                    @if(Auth::user()->email)
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{Auth::user()->email}}</p>
                    @endif
                    {{-- Phone number of the User --}}
                    @if(Auth::user()->phone)
                        <p><i class="fa fa-phone" aria-hidden="true"></i> {{Auth::user()->phone}}</p>
                    @endif
                    {{-- Home Address of the User --}}
                    @if(Auth::user()->city || Auth::user()->address)
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>{{Auth::user()->address}}, {{Auth::user()->city}}</p>
                    @endif
                </div>
                <div class="col-md-8">
                    {{-- <img class="img-responsive img-rounded" src="{{Auth::user()->photo ? Auth::user()->photo['file'] : 'http://via.placeholder.com/200x200'}}" alt=""> --}}
                </div>
            </div>
        </div>
    </div>
@endsection