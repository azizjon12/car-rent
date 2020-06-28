{{-- In this file we will create a view for Choosing a Carpage with some
    fields that need to be selected by a Customer  --}}

{{-- Extending a layouts/app view because this file is available for the users and guests --}}
@extends('layouts.app')

{{-- Linking a stylesheet to the page --}}
@section('styles')
    <link href="{{asset('css/libs/filter-style.css')}}" rel="stylesheet">
@endsection

{{-- Below is the content of the Page --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {{-- Top Section of the page showing the progression of the Reservation --}}
                <ul class="four steps steps1">
                    <li class="completed"></li>
                    <li class="completed"><a href="#">1</a><br><span class="stepstext">{!! trans('home.CHOOSE_VEHICLE') !!}</span></li>
                    <li class="text-center"><a href="#">2</a><br><span class="stepstext">{!! trans('home.CHOOSE_EXTRAS') !!}</span></li>
                    <li><a href="#">3</a><br><span class="stepstext steplast">{!! trans('home.CONFIRM') !!}</span></li>
                </ul>
                {{-- <a href="{{url('/')}}" class="btn btn-primary">Go Back</a> --}}
            </div>
        </div>
    </div>

    <div class="container">
    {{-- Include for-errors file for error checking --}}
    @include('includes.form-errors')

    {{-- Here we call additionale_services method of the RentalCarsController which 
        is responsible for displaying Cars to a user/guest --}}
    {!! Form::open(['method' => 'GET', 'action' => 'RentalCarsController@additional_services', 'id'=>'car-rental-form', 'files'=>true]) !!}

    {{--<div class="col-md-12">
        <button href="#" onclick="return false;" class="btn btn-rent-title">{!! trans('home.Choose_Car_in') !!} 
        @foreach($branches as $branch)
            @if($branch->id == $branch_pickup)
                {{$branch->name}}
            @endif
        @endforeach
        </button>
    </div>--}}

    {{-- Some information selected by a user/guest is hidden --}}
    <input type="hidden" name="branch_pickup" value="{{$branch_pickup}}">
    <input type="hidden" name="branch_return" value="{{$branch_return}}">
    <input type="hidden" name="pickupDate" value="{{$pickupDate}}">
    <input type="hidden" name="returnDate" value="{{$returnDate}}">
    <input type="hidden" name="pickupTime" value="{{$pickupTime}}">
    <input type="hidden" name="returnTime" value="{{$returnTime}}">

    {{-- DateInterval::format of the PHP Language
        The number of days as a result of a DateTime::diff() --}}
    @php ($date1=date_create($pickupDate))
    @php ($date2=date_create($returnDate))
    @php ($diff=date_diff($date1,$date2))
    @php ($result=$diff->format("%a"))

    <main class="cd-main-content">
        <div class="vehicles cd-gallery filter-is-visible">
            {{-- Checking whether pick-up and return locations are the same 
                If they are not the same, dislocation message will show up,
                subsequently dislocation fee will be charged --}}
            @if($branch_return)
                @if($branch_pickup != $branch_return)
                    <div class="clearfix"></div>
                    <div style="margin: 0 15px 30px;" class="col-md-12 alert alert-info">
                        <i class="fa fa-exclamation-circle"></i>
                        <strong>
                            {{-- Displaying a Pick-up Location name with the message --}}
                            @foreach($branches as $branch)
                                @if($branch->id == $branch_pickup)
                                    {{$branch->name}}
                                @endif
                            @endforeach
                        </strong>
                        pick-up location is different to return location 
                        <strong>
                            {{-- Displaying a Return Location name with the message --}}
                            @foreach($branches as $branch)
                                @if($branch->id == $branch_return)
                                    {{$branch->name}}
                                @endif
                            @endforeach
                        </strong>
                        . There is a fee of <b>£80</b> for changing the return location. 
                    </div>
                @endif
            @endif

            {{-- Checking for correct pick-up and return time
                because of the opening hours --}}
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

            {{-- Displaying a message for a user/guest --}}
            @if($over_time_pickup_cond == 1 || $over_time_return_cond == 1)
                <div style="margin: 0 15px 30px;" class="col-md-12 alert alert-info">
                    <i class="fa fa-exclamation-circle"></i>
                    The chosen time interval exceeds the hours of the program.
                    An Extra Hours fee of
                    <strong>£{{$over_time}}</strong> will apply for this reservation. <br>
                    Schedule: <strong>Monday to Sunday from 08:00 to 18:00.</strong>
                    <div class="clearfix"></div>
                </div>

            @endif
            <ul>
                {{-- Now, showing all the availabe Car for the entered pick-up and 
                    return date time and it's location --}}
                @foreach($cars as $car)
                    @if($car->branch->id == $branch_pickup && $car->is_available == 1)
                        <li class="mix {{$car->name}} {{$car->type->name}} {{$car->gearbox->name}}">
                            <div class="rental_item">
                                <div class="wrap_img">
                                    <div class="relative">
                                        <img class="featured" height="150" src="{{$car->photo->file}}" alt="">
                                        <div class="flex-zone">
                                            <div class="flex-zone-inside">
                                                <a class="button-rent-it">{!! trans('home.SELECT_CAR') !!}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <div class="wrap_btn">
                                            <a href="#" class="btn_price">
                                                <span class="wrap_content"><span class="amount"><span price="{{$car->daily_price}}" class="price-amount"><span class="currencySymbol">£</span>{{$car->daily_price}}</span></span><span class="time">/ {!! trans('home.Day') !!} </span></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    {{-- Displaying Car information, such as name, Car type, 
                                        transmission and fuel types and etc. --}}
                                    <h3  name="{{$car->id}}" class="title name">{{$car->name}}</h3>
                                    <div class="car-type"><span>{{$car->type->name}}</span></div>
                                    <div class="features">
                                        <div class="container-fluid">
                                            <div class="row">
                                                @if($car->ac == 1)
                                                    <div class="feature-item odd"> <img src="{{asset('public/img/icons/ac.png')}}" alt=""><span>A/C</span></div>
                                                @endif
                                                @if($car->gearbox->name)
                                                    <div class="feature-item eve">
                                                        <img src="{{asset('public/img/icons/cog.png')}}" alt=""><span>{{$car->gearbox->name}}</span>
                                                    </div>
                                                @endif
                                                @if($car->fuel->name)
                                                    <div class="feature-item odd">
                                                        <img src="{{asset('public/img/icons/gas-pump.png')}}" alt=""><span>{{$car->fuel->name}}</span>
                                                    </div>
                                                @endif
                                                @if($car->num_passengers)
                                                    <div class="feature-item eve">
                                                        <img src="{{asset('public/img/icons/man.png')}}" alt=""><span>{{$car->num_passengers}}</span>
                                                    </div>
                                                @endif
                                                @if($car->bags_capacity)
                                                    <div class="feature-item odd">
                                                        <img src="{{asset('public/img/icons/luggage.png')}}" alt=""><span>{{$car->bags_capacity}}</span>
                                                    </div>
                                                @endif
                                                @if($car->num_doors)
                                                    <div class="feature-item eve">
                                                        <img src="{{asset('public/img/icons/doors.png')}}" alt=""><span>{{$car->num_doors}}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            {{-- If there is not any Car available, then we will print out the following message --}}
            </ul>
             <div class="cd-fail-message">No results found</div>
        </div>

        <div class="cd-filter filter-is-visible">
            <div class="cd-filter-block">
                <div class="cd-filter-content">
                    <br>
                    <input type="search" placeholder="Search for ...">
                </div>
            </div>

            {{-- Filter function for the Transmission types --}}
            <div class="cd-filter-block">
                <h4>Transmissions</h4>
                <ul class="cd-filter-content cd-filters list">
                    @foreach($transmissions as $transmission)
                    <li>
                        <input class="filter" data-filter=".{{$transmission->name}}" type="checkbox" name="radioButton" id="{{$transmission->name}}">
                        <label class="checkbox-label" for="{{$transmission->name}}"><span>{{$transmission->name}}</span></label>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Filter function for the Car types --}}
            <div class="cd-filter-block">
                <h4>Types</h4>
                <ul class="cd-filter-content cd-filters list">
                    @foreach($types as $type)
                    <li>
                        <input class="filter" data-filter=".{{$type->name}}" type="checkbox" id="{{$type->name}}">
                        <label class="checkbox-label" for="{{$type->name}}"><span>{{$type->name}}</span></label>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- <a href="#0" class="cd-filter-trigger">Search Carrr</a> --}}
        <a href="{{url('/')}}" class="cd-filter-trigger">Go Back</a>
        <br>
        
    </main>

    <input class="car-id required" type="hidden" name="car_id" value="">
    <input type="hidden" name="status" value="0">

    {{-- Proceeding to the next step, Choosing Extras --}}
    <div id="next-step">
        <div class="form-group">
            {!! Form::submit(Lang::get('home.CHOOSE_EXTRAS'), ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    <p class="text"></p>
    <p class="total"></p>

    <div class="clearfix"></div>
    {!! Form::close() !!}
</div>

@endsection

{{-- Linking JavaScript files to the Page --}}
@section('footer')
    <script src="{{asset('js/libs/modernizr.js')}}"></script>
    <script src="{{asset('js/libs/jquery.mixitup.min.js')}}"></script>
    <script src="{{asset('js/libs/filter-main.js')}}"></script>
    <script>
        $(function() {
            /* Function for Selecting a Car */
            $('.vehicles .rental_item').on('click', function(){

                var name = $('.name', this ).attr('name');
                $('.car-id' ).attr( "value", name );

                $('.vehicles .rental_item .flex-zone' ).removeClass( "active");
                $('.vehicles .rental_item .flex-zone .button-rent-it' ).text('<?php echo __('home.SELECT_CAR') ?>');

                $('.flex-zone', this ).addClass( "active");
                $('.flex-zone .button-rent-it',this ).text('<?php echo __('home.SELECTED') ?>');

            });
        });
    </script>
@endsection