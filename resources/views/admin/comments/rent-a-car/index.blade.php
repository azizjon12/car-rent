{{-- In this file we will create a view for All Reservations  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    {{-- First we will check whether we have rental cars by writing an if  statement. 
        If the number of rental cars is greater than 0, then  we will list them by their ID numbers --}}
    @if(count($rentalcars) > 0)
        <h1>{!! trans('home.All') !!} {!! trans('home.Reservations') !!}</h1>
        <div class="col-md-12">
            <table class="table-responsive-design">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{!! trans('home.Car') !!}</th>
                        <th scope="col">{!! trans('home.Reservation') !!}</th>
                        <th scope="col">{!! trans('home.PRICE') !!}</th>
                        <th scope="col">{!! trans('home.customer') !!}</th>
                        <th scope="col">{!! trans('home.Status') !!}</th>
                        <th scope="col">{!! trans('home.Action') !!}</th>
                    </tr>
                </thead>
                <tbody>
                @if($rentalcars)
                    {{-- Foreach loops is been used to list all the Cars --}}
                    @foreach($rentalcars as $rentalcar)
                        <tr>
                            <td data-label="ID">{{$rentalcar->id}}</td>
                            <td data-label="{!! trans('home.Car') !!}">{{$rentalcar->car->name}}</td>
                            {{-- This small table will display all other details of the Reservation, 
                                such as pick-up and return dates and time and their location  --}}
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
                                       </table>" title="{!! trans('home.Reservation') !!}" data-html="true" class="btn btn-info">{!! trans('home.Reservation') !!}</a>
                            </td>
                            <td data-label="{!! trans('home.PRICE') !!}">£ {{$rentalcar->price}}</td>
                            {{-- This small table will display all other details of the Customer, 
                                such as name, email, home address, city and phone number  --}}
                            <td data-label="{!! trans('home.customer') !!}" align="left" width="90%"><a data-toggle="popover" data-trigger="click" data-content="<table class='table table-bordered'>
                                       <tr>
                                        <td>Name:</td><td>{{$rentalcar->user->name}}</td>
                                       </tr>
                                       <tr>
                                        <td>Email:</td><td>{{$rentalcar->user->email}}</td>
                                       </tr>
                                       @if($rentalcar->user->phone)
                                       <tr>
                                        <td>{!! trans('home.Phone') !!}:</td><td>{{$rentalcar->user->phone}}</td>
                                       </tr>
                                       @endif
                                       <tr>
                                         <td>{!! trans('home.Address') !!}:</td><td>{{$rentalcar->user->address}}</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.City') !!}:</td><td>{{$rentalcar->user->city}}</td>
                                       </tr>
                                        
                                       </table>" title="{!! trans('home.customer') !!}" data-html="true" class="btn btn-info">{!! trans('home.customer') !!}</a>
                            </td>
                            {{-- This column is responsible for keeping the Status of the Reservation
                                The followings are the example of the Status --}}
                            <td data-label="{!! trans('home.Status') !!}">
                                @if($rentalcar->status == 0)
                                    <span>{!! trans('home.Not') !!} {!! trans('home.Confirmed') !!}</span>
                                @elseif($rentalcar->status == 1)
                                    <span>{!! trans('home.Confirmed') !!}</span>
                                @elseif($rentalcar->status == 2)
                                    <span>{!! trans('home.Delivered') !!}</span>
                                @elseif($rentalcar->status == 3)
                                    <span>{!! trans('home.Returned') !!}</span>
                                @endif
                            </td>
                            {{-- This column is responsible for Confirming the Reservation --}}
                            <td data-label="{!! trans('home.Action') !!}">
                                @if($rentalcar->status == 0)
                                    {!! Form::model($rentalcar, ['method' => 'PATCH', 'action' => ['RentalCarsController@update', $rentalcar->id] ]) !!}
                                    <input type="hidden" name="status" value="1">
                                    <div class="form-group">
                                        {!! Form::submit(Lang::get('home.Confirm'), ['class' => 'btn btn-success']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                @elseif($rentalcar->status == 1)
                                    @php($car_picked_up = Lang::get('home.Car') . ' ' . Lang::get('home.Picked_Up') )
                                    {!! Form::model($rentalcar, ['method' => 'PATCH', 'action' => ['RentalCarsController@update', $rentalcar->id] ]) !!}
                                    <input type="hidden" name="status" value="2">
                                    <div class="form-group">
                                        {!! Form::submit($car_picked_up, ['class' => 'btn btn-success']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                @elseif($rentalcar->status == 2)
                                    @php($car_returned = Lang::get('home.Car') . ' ' . Lang::get('home.Returned') )
                                    {!! Form::model($rentalcar, ['method' => 'PATCH', 'action' => ['RentalCarsController@update', $rentalcar->id] ]) !!}
                                    <input type="hidden" name="status" value="3">
                                    <div class="form-group">
                                        {!! Form::submit($car_returned, ['class' => 'btn btn-success']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    {{-- If there is not a Car, then we will print out that there are not Cars Available --}}
    @else
        <h1>{!! trans('home.Not') !!} {!! trans('home.Reservations') !!} {!! trans('home.Cars') !!}</h1>
    @endif
@endsection

{{-- Here we include a Bootstrap Popover plugin which halps us to display 
    information effectively in a way of a small table --}}
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection