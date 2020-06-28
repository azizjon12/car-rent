{{-- In this file we will create a view for User Reservation
    where a User can view their reservations and their status --}}

{{-- Extending a layouts/app view because this file is available for the users --}}
@extends('layouts.app')

{{-- Below is the content of the Page --}}
@section('content')
    <div class="container user-information-section">
        <div class="row">
            {{-- Below is Side nav bar for Users only --}}
            <div class="col-md-3">
                <ul id="nav-tabs-wrapper" class="nav nav-pills nav-stacked well menu-my-account">
                    <li><a href="{{route('user.user-profile')}}" title="">Account</a></li>
                    <li><a href="{{route('user.user-edit')}}" title="">Edit {!! trans('home.Profile') !!}</a></li>
                    <li class="active"><a href="{{route('user.user-reservations')}}" title="">{!! trans('home.Reservations') !!}</a></li>
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
                    {{-- Address and City of the User --}}
                    @if(Auth::user()->city || Auth::user()->address)
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{Auth::user()->address}}, {{Auth::user()->city}}</p>
                    @endif
                </div>
                <div class="col-md-8">
                    {{-- <img class="img-responsive img-rounded" src="{{Auth::user()->photo ? Auth::user()->photo['file'] : 'http://via.placeholder.com/200x200'}}" alt=""> --}}
                    
                    {{-- <h1 class="name">{{Auth::user()->name}}</h1>
                    @if(Auth::user()->email)
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{Auth::user()->email}}</p>
                    @endif
                    @if(Auth::user()->phone)
                        <p><i class="fa fa-phone" aria-hidden="true"></i> {{Auth::user()->phone}}</p>
                    @endif
                    @if(Auth::user()->city || Auth::user()->address)
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{Auth::user()->city}}, {{Auth::user()->address}}</p>
                    @endif --}}
                </div>
            <div class="col-md-12">
                
            <h1 class="name margin-top40">{!! trans('home.Reservations') !!}</h1>
            @if($rentalcars)
                @foreach($rentalcars as $rentalcar)
                    @if($rentalcar->user_id == $user->id)
                    
                    <table class="table-responsive-design">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">{!! trans('home.Car') !!}</th>
                            <th scope="col">{!! trans('home.Reservation') !!}</th>
                            <th scope="col">{!! trans('home.PRICE') !!}</th>
                            <th scope="col">{!! trans('home.Status') !!}</th>
                        </tr>
                        </thead>
                        <tbody>
                    <tr>
                        <td data-label="ID">{{$rentalcar->id}}</td>
                        <td data-label="{!! trans('home.Car') !!}">{{$rentalcar->car->name}}</td>
                        <td data-label="{!! trans('home.Reservation') !!}" align="left" width="90%"><a data-toggle="popover" data-trigger="click" data-content="<table class='table table-bordered'>
                       <tr>
                        <td>{!! trans('home.Pickup_Location') !!}:</td><td>{{$rentalcar->pickupConfiguration->location}}</td>
                        </tr>
                        <tr>
                        <td>{!! trans('home.Return_Location') !!}:</td><td>{{$rentalcar->returnConfiguration ? $rentalcar->returnConfiguration->location : $rentalcar->pickupConfiguration->location}}</td>
                        </tr>
                        <tr>
                        <td>{!! trans('home.Pickup_Date') !!}:</td><td>{{$rentalcar->pickupDate}}</td>
                        </tr>
                        <tr>
                        <td>{!! trans('home.Return_Date') !!}:</td><td>{{$rentalcar->returnDate}}</td>
                        </tr>
                        <tr>
                        <td>{!! trans('home.Pickup_Time') !!}:</td><td>{{$rentalcar->pickupTime}}</td>
                        </tr>
                        <tr>
                        <td>{!! trans('home.Return_Time') !!}:</td><td>{{$rentalcar->returnTime}}</td>
                        </tr>
                        {{-- <tr>
                        <td>{!! trans('home.Flight_number') !!}:</td><td>{{$rentalcar->flight_number}}</td>
                        </tr>
                        <tr>
                        <td>{!! trans('home.Reservation_info') !!}:</td><td>{{$rentalcar->reservation_info}}</td>
                        </tr> --}}
                       </table>" title="{!! trans('home.Reservation') !!}" data-html="true" class="btn btn-info">{!! trans('home.Reservation') !!}</a>
                        </td>
                        <td data-label="{!! trans('home.PRICE') !!}">£ {{$rentalcar->price}}</td>
                        <td data-label="{!! trans('home.Status') !!}">
                            @if($rentalcar->status == 0)
                                <span>{!! trans('home.Status1') !!}</span>
                            @elseif($rentalcar->status == 1)
                                <span>{!! trans('home.Status2') !!}</span>
                            @elseif($rentalcar->status == 2)
                                <span>{!! trans('home.Status3') !!}</span>
                            @elseif($rentalcar->status == 3)
                                <span>{!! trans('home.Status4') !!}</span>
                            @endif
                        </td>
                    </tr>
                    
                    </tbody>
                    </table>
                    @endif
                @endforeach
            @endif
            </div>
            </div>
        </div>
    </div>
@endsection

{{-- Here we include a Bootstrap Popover plugin  which helps us to display information 
    effectively in a way of a small table  --}}
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection