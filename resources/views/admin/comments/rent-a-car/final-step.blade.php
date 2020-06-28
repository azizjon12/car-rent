{{-- In this file we will create a view for Final Step of the Reservation Process  --}}

{{-- Extending a layouts/app view because this file is available for the users and guests --}}
@extends('layouts.app')

{{-- Below is the content of the Page --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {{-- Top Section of the page showing the progression of the Reservation --}}
                <ul class="four steps steps1">
                    <li class="complete"></li>
                    <li class="complete"><a href="#">1</a><br><span class="stepstext">{!! trans('home.CHOOSE_VEHICLE') !!}</span></li>
                    <li class="complete"><a href="#">2</a><br><span class="stepstext">{!! trans('home.CHOOSE_EXTRAS') !!}</span></li>
                    <li class="complete"><a href="#">3</a><br><span class="stepstext steplast">{!! trans('home.CONFIRM') !!}</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        {{-- Here we call store method of the RentalCarsController which 
            is responsible for storing a newly created Reservation by a user --}}
        {!! Form::open(['method' => 'POST', 'action' => 'RentalCarsController@store','id'=>'final-step-form', 'files'=>true]) !!}
        
        {{-- Include form-errors for error checking --}}
        @include('includes.form-errors')

        {{-- The following information been hidden because they were already selected in the first step --}}
        <input type="hidden" name="branch_pickup" value="{{$branch_pickup}}">
        <input type="hidden" name="branch_return" value="{{$branch_return}}">
        <input type="hidden" name="pickupDate" value="{{$pickupDate}}">
        <input type="hidden" name="returnDate" value="{{$returnDate}}">
        <input type="hidden" name="pickupTime" value="{{$pickupTime}}">
        <input type="hidden" name="returnTime" value="{{$returnTime}}">
        <input type="hidden" name="car_id" value="{{$car_id}}">
        @php ($date1=date_create($pickupDate))
        @php ($date2=date_create($returnDate))
        @php ($diff=date_diff($date1,$date2))
        @php ($days=$diff->format("%a"))
        @if($days == 0)
            @php ( $days = 1 )
        @endif
        <div class="row car-details-row">
            {{-- Displaying all the information such as Car name Protection packages
                 and Total Price. It will be shown on the left side if used by a desktop PC --}}
            <div class="col-md-6 car_details">
                {{-- <button href="#" onclick="return false;" class="btn btn-rent-title">{!! trans('home.CONFIRM') !!}</button> --}}
                @foreach($cars as $car)
                    @if($car->id == $car_id)
                        @php ($total_price = $days * $car->daily_price)
                        <h1 class="car-name">{{$car->type->name}} | {{$car->name}}</h1>
                        <p class="days"> {!! trans('home.Rent_for') !!} <strong>{{$days}}</strong> {!! trans('home.Day_s') !!} <strong class="pull-right">£{{$days * $car->daily_price}}</strong></p>
                        @if($garantie == 1)
                            <p class="garantie-car">Protection <span class="warranty-name">Medium</span> <span class="pull-right"> <b class="warranty-price">£{{18 * $days}}</b></span></p>
                        @elseif($garantie == 3)
                            <p class="garantie-car">Protection <span class="warranty-name">Basic</span> <span class="pull-right"> <b class="warranty-price">0</b></span></p>
                        @elseif($garantie == 2)
                            <p class="garantie-car">Protection <span class="warranty-name">Premium</span> <span class="pull-right"> <b class="warranty-price">{{65 * $days}}</b> <b>$</b></span></p>
                        @endif
                        <p class="additional-car-services-title">{!! trans('home.ADDITIONAL_SERVICES') !!}</p>
                        <div id="fulloptions">
                            @if($car_satnav)
                                @php($total_price += $car_satnav)
                                <p>{!! trans('home.SATNAV') !!} x {{$days}} {!! trans('home.Day_s') !!}<strong class="pull-right">{{$car_satnav}} $</strong></p>
                            @endif
                            @if($car_baby_seat)
                                @php($total_price += $car_baby_seat)
                                <p>{!! trans('home.CHILD_SEAT') !!} x {{$days}} {!! trans('home.Day_s') !!}<strong class="pull-right">{{$car_baby_seat}} $</strong></p>
                            @endif
                            @if($car_child_seat)
                                @php($total_price += $car_child_seat)
                                <p>{!! trans('home.BABY_SEAT') !!} x {{$days}} {!! trans('home.Day_s') !!}<strong class="pull-right">{{$car_child_seat}} $</strong></p>
                            @endif
                        <br>
                        <br>
                        </div>
                        <?php $dislocation = 0; ?>
                        @if($branch_return)
                            @if($branch_pickup != $branch_return)
                                <p>
                                    Dislocation
                                    <strong>
                                        {{-- Pick-up Location --}}
                                        @foreach($branches as $branch)
                                            @if($branch->id == $branch_pickup)
                                                {{$branch->name}}
                                            @endif
                                        @endforeach
                                        -
                                        {{-- Return Location --}}
                                        @foreach($branches as $branch)
                                            @if($branch->id == $branch_return)
                                                {{$branch->name}}
                                            @endif
                                        @endforeach
                                    </strong>
                                    <strong class="pull-right">£80</strong>
                                </p>
                                <?php  $dislocation = 80; ?>
                            @endif
                        @endif

                        <?php
                        $interval_start = strtotime('08:00');
                        $interval_end = strtotime('18:10');
                        $pickup_time = strtotime($pickupTime);
                        $return_time = strtotime($returnTime);
                        $over_time_pickup = 0;
                        $over_time_pickup_cond = 0;
                        $over_time_return = 0;
                        $over_time_return_cond = 0;
                        $over_time = 0;

                        if($interval_start <= $pickup_time && $pickup_time < $interval_end) {}
                        else { $over_time_pickup = 20; $over_time_pickup_cond = 1; }

                        if($interval_start <= $return_time && $return_time < $interval_end) {}
                        else { $over_time_return = 20; $over_time_return_cond = 1; }

                        $over_time = $over_time_pickup + $over_time_return;
                        ?>

                        @if($over_time_pickup_cond == 1 || $over_time_return_cond == 1)
                            <p>Program additional charges
                                <strong class="pull-right">{{$over_time}} $</strong>
                            </p>
                        @endif

                        <?php $garantie_total = 0; ?>
                        @if($garantie == 1)
                            <?php $garantie_total = 18 * $days ?>
                        @elseif($garantie == 3)
                            <?php $garantie_total = 0 ?>
                        @elseif($garantie == 2)
                            <?php $garantie_total = 65 * $days ?>
                        @endif

                        <br><br>

                        {{-- Total Price of the Reservation --}}
                        <h3 class="total">{!! trans('home.Total_price') !!}: <span class="pull-right">£{{$total_price + $dislocation+$over_time+$garantie_total}}</span></h3>
                    @endif
                @endforeach
            </div>
            <div class="col-md-6 user_details">
                {{-- <button href="#" onclick="return false;" class="btn btn-rent-title">{!! trans('home.Personal_Data') !!}</button> --}}
                
                {{-- Checking whether User has been registered. If so, the followings are 
                    the User's details --}}
                @if(Auth::user())
                <p>{!! trans('home.Full_Name') !!}: {{Auth::user()->name}}</p>
                @if(Auth::user()->address)
                    <p>{!! trans('home.Address') !!}:  {{Auth::user()->address}}</p>
                @endif
                @if(Auth::user()->phone)
                    <p>{!! trans('home.Phone') !!}:  {{Auth::user()->phone}}</p>
                @endif
                @if(Auth::user()->email)
                    <p>Email:  {{Auth::user()->email}}</p>
                @endif

                {{-- If it is a newly non-registered User, we will will ask them
                    to fill the following boxes to register --}}
                @else
                    <div class="row">
                        {{-- Full Name of the User --}}
                        <div class="form-group col-md-6">
                            {!! Form::label('name', Lang::get('home.Full_Name')) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                        {{-- Email of the User --}}
                        <div class="form-group col-md-6">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            {!! Form::label('address', Lang::get('home.Address')) !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-md-6">
                            {!! Form::label('postcode', Lang::get('home.Postcode')) !!}
                            {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    {{-- User's home address --}}
                    {{-- Postcode of the home address --}}
                    {{-- <div class="row">
                        
                        <div class="form-group col-md-6">
                            {!! Form::label('address', Lang::get('home.Address')) !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <div class="form-group col-md-6">
                            {!! Form::label('postcode', Lang::get('home.Postcode')) !!}
                            {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
                        </div>
                    </div> --}}
                    <div class="row">
                        {{-- User's city --}}
                        <div class="form-group col-md-6">
                            {!! Form::label('city', Lang::get('home.City')) !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>
                        {{-- Phone number of the User --}}
                        <div class="form-group col-md-6">
                            {!! Form::label('phone', Lang::get('home.Phone')) !!}
                            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        {{-- Password for the User --}}
                        <div class="form-group col-md-6">
                            {!! Form::label('password', Lang::get('home.Password')) !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                        {{-- Confirm the Password --}}
                        <div class="form-group col-md-6">
                            {!! Form::label('password_confirmation', Lang::get('home.Password_Confirm')) !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    {{-- Accepting Car-Rent's Terms and Conditions --}}
                    {{-- <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('password', Lang::get('home.Read_Agreed')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <label class="checkboxes-final-form">
                        <div class="form-group col-md-12 checkbox-inline">
                            {!! Form::checkbox('terms_condition', null, null, ['class' => 'checkboxe-final-form']) !!}<span class="checkmark"></span>
                            {{ Lang::get('home.Terms_Conditions') }}
                        </div>
                        </label>
                    </div>
                    <div class="row">
                        <label class="checkboxes-final-form">
                            <div class="form-group col-md-12 checkbox-inline">
                                {!! Form::checkbox('personal_data', null, null, ['class' => 'checkboxe-final-form']) !!}<span class="checkmark"></span>
                                {{ Lang::get('home.Personal_Data_Policy') }}
                            </div>
                        </label>
                    </div> --}}
                @endif
                {{-- Button for "Pay on Pick-Up" ie Confirming Reservation --}}
                <div class="form-group text-left">
                    {!! Form::submit(Lang::get('home.Pay_on_pick-up'), ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
        <div class="row car-details-row">
            <input type="hidden" name="price" value="{{$total_price + $dislocation + $over_time +$garantie_total}}">
        </div>
        {!! Form::close() !!}
    </div>
@endsection