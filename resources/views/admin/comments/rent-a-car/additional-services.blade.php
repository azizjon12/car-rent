{{-- In this file we will create a view for selecting Protection Packages (Insurance) with some
    fields that need to be selected by a Customer/Guest  --}}

{{-- Extending a layouts/app view because this file is available for the users and guests --}}
@extends('layouts.app')

{{-- Below is the content of the Page --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{-- Top Section of the page showing the progression of the Reservation --}}
            <ul class="four steps steps1">
                <li class="completed"></li>
                <li class="completed"><a href="#">1</a><br><span class="stepstext">{!! trans('home.CHOOSE_VEHICLE') !!}</span></li>
                <li class="completed" class="text-center"><a href="#">2</a><br><span class="stepstext">{!! trans('home.CHOOSE_EXTRAS') !!}</span></li>
                <li><a href="#">3</a><br><span class="stepstext steplast">{!! trans('home.CONFIRM') !!}</span></li>
            </ul>
        </div>
        {{-- <a href="{{url('/')}}" class="btn btn-info">Go Back</a> --}}
    </div>
</div>
<div class="container">
    {!! Form::open(['method' => 'GET', 'action' => 'RentalCarsController@final_step','id'=>'additional-services-form', 'files'=>true]) !!}
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

    <div class="row radio-toolbar hidden-sm hidden-xs">
        <div class="col-md-12">
            {{-- <button href="#" onclick="return false;" class="btn btn-rent-title">Warranty</button> --}}
            <h1>{{ trans('home.protection_packages') }}</h1>
            <br><br>
        </div>

        {{-- Displaying a Protection Package called "Basic" --}}
        <div class="col-xs-12 col-md-4  boxgarantie">
            <input type="radio" class="garantie hidden" id="fara acoperire" name="garantie" value="3">
            <label for="fara acoperire">
                <div class="panel panelprice">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic</h3>
                        <h2 class="sub-panel-title"></h2>
                        <p class="sub-panel-paragraf">Reduce my excess to </p>
                        <span class="panel-price">£700</span>
                    </div>
                    <div class="panel-body tooltip-div">
                        <div class="the-price">
                            <h1>£<span class="the-price-val">0</span> / day</h1>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="col-md-10 col-md-offset-1 tooltip-div">
                            <button onclick="return false;" class="btn col-md-12 buttonrezervaclick" role="button"><b>CHOOSE  </b></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </label>
        </div>

        {{-- Displaying a Protection Package called "Medium" and it is pre-selected --}}
        <div class="col-xs-12 col-md-4  boxgarantie active">
            <input type="radio" class="garantie hidden" id="limitat" name="garantie" value="1" checked="">
            <label for="limitat">
                <div class="panel panelprice">
                    <div class="panel-heading">
                        <div class="cnrflash"><div class="cnrflash-inner"><span class="cnrflash-label">Most<br>Popular</span></div></div>
                        <h3 class="panel-title">Medium</h3>
                        <h2 class="sub-panel-title"></h2>
                        <p class="sub-panel-paragraf">Reduce my excess to </p>
                        <span class="panel-price">£250</span>
                    </div>
                    <div class="panel-body tooltip-div">
                        <div class="the-price">
                            <h1>£<span class="the-price-val">18</span> / day</h1>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="col-md-10 col-md-offset-1 tooltip-div">
                            <button onclick="return false;" class="btn col-md-12 buttonrezervaclick" role="button"><b>CHOSEN  </b></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </label>
        </div>

        {{-- Displaying a Protection Package called "Premium" --}}
        <div class="col-xs-12 col-md-4  boxgarantie">
            <input type="radio" class="garantie hidden" id="relaxat" name="garantie" value="2">
            <label for="relaxat">
                <div class="panel panelprice">
                    <div class="panel-heading">
                        <h3 class="panel-title">Premium</h3>
                        <h2 class="sub-panel-title"></h2>
                        <p class="sub-panel-paragraf">Reduce my excess to </p>
                        <span class="panel-price">£0</span>
                    </div>
                    <div class="panel-body tooltip-div">
                        <div class="the-price">
                            <h1>£<span class="the-price-val">65</span> / day</h1>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="col-md-10 col-md-offset-1 tooltip-div">
                            <button onclick="return false;" class="btn col-md-12 buttonrezervaclick" role="button"><b>CHOOSE</b></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </label>
        </div>

    </div>

    {{-- Displaying other Extra packages such as SatNav, Child and Baby Seats --}}
    <div class="row additional-services-row">
    @foreach($cars as $car)
        @if($car->id == $car_id)
            @if($car->satnav || $car->child_seat || $car->baby_seat /* || $car->wifi_price || $car->snow_chains || $car->sky_support*/ )
                <div class="col-md-12">
                    {{-- <button href="#" onclick="return false;" class="btn btn-rent-title">{!! trans('home.ADDITIONAL_SERVICES') !!}</button> --}}
                </div>
            @endif
            <div class="clearfix"></div>

            {{-- Displaying Extra Package: SatNav --}}
            @if($car->satnav)
                <div class="col-md-4 echipamentebox">
                    <input name="car_satnav" id="echipamente6" class="echipamente hidden" type="checkbox" value="{{$car->satnav * $days}}">
                    <label for="echipamente6">
                        <div class="serviciibox">
                            <div class="col-md-4 boxright">
                                <img class="pull-left" width="64" height="64" src="{{asset('/public/img/additionals/gps.png')}}" title="">
                            </div>
                            <div class="col-md-8 zi9 boxleft">
                                <span class="titleechipament titleechipament6">{!! trans('home.SATNAV') !!}</span>
                                <p price="{{$car->satnav}}" class="echipamentep echipamentep6">£{{$car->satnav}} / {!! trans('home.Day') !!}</p>
                            </div>
                        </div>
                    </label>
                </div>
            @endif

            {{-- Displaying Extra Package: Child Seat --}}
            @if($car->child_seat)
                <div class="col-md-4 echipamentebox">
                    <input name="child_seat" id="echipamente5" class="echipamente hidden" type="checkbox" value="{{$car->child_seat * $days}}">
                    <label for="echipamente5">
                        <div class="serviciibox">
                            <div class="col-md-4 boxright">
                                <img class="pull-left" width="64" height="64" src="{{asset('/public/img/additionals/child_seat.png')}}" title="">
                            </div>
                            <div class="col-md-8 zi9 boxleft">
                                <span class="titleechipament titleechipament5">{!! trans('home.CHILD_SEAT') !!}</span>
                                <p price="{{$car->child_seat}}" class="echipamentep echipamentep5">£{{$car->child_seat}} / {!! trans('home.Day') !!}</p>
                            </div>
                        </div>
                    </label>
                </div>
            @endif

            {{-- Displaying Extra Package: Baby Seat --}}
            @if($car->baby_seat)
                <div class="col-md-4 echipamentebox"><input name="baby_seat" id="echipamente4" class="echipamente hidden" type="checkbox" value="{{$car->baby_seat * $days}}">
                    <label for="echipamente4">
                        <div class="serviciibox">
                            <div class="col-md-4 boxright">
                                <img class="pull-left" width="64" height="64" src="{{asset('/public/img/additionals/baby_seat.png')}}" title="">
                            </div>
                            <div class="col-md-8 zi9 boxleft">
                                <span class="titleechipament titleechipament4">{!! trans('home.BABY_SEAT') !!}</span>
                                <p price="{{$car->baby_seat}}" class="echipamentep echipamentep4">£{{$car->baby_seat}} / {!! trans('home.Day') !!}</p>
                            </div>
                        </div>
                    </label>
                </div>
            @endif
        @endif
    @endforeach
    </div>

    {{-- Displaying all the information with their prices which were
        selected at this stage --}}
    <div class="row car-details-row">
        <div class="col-md-6 car_details">
            @foreach($cars as $car)
                @if($car->id == $car_id)
                    <h1 class="car-name">{{$car->type->name}} {{$car->name}}</h1>
                    <p class="days"> {!! trans('home.Rent_for') !!} <strong>{{$days}}</strong> day/s <strong class="pull-right">£ {{$days * $car->daily_price}}</strong></p>
                    <p class="garantie-car">Protection <span class="warranty-name">Medium</span> <span class="pull-right"> <b class="warranty-price">£ {{18*$days}}</b></span></p>
                    <p class="additional-car-services-title">{!! trans('home.ADDITIONAL_SERVICES') !!}</p>
                    <div id="fulloptions"></div>

                    <br>
                    <br>
                    <br>
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
                                <strong class="pull-right">£ 80</strong>
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
                            <strong class="pull-right">£{{$over_time}}</strong>
                        </p>
                    @endif

                    <br><br>

                    {{-- Displaying Total Price for the Reservation --}}
                    <h3 class="total">{!! trans('home.Total_price') !!}: <span class="pull-right">£{{($days * $car->daily_price)+$dislocation+$over_time+(18*$days)}}</span></h3>
                    <p class="calculate hidden" price="{{$car->daily_price}}" days="{{$days}}"></p>
                @endif
            @endforeach
            {{-- Button for "Confirm"-ing the Reservation --}}
            <div class="form-group">
                {!! Form::submit(Lang::get('home.CONFIRM'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        <div class="col-md-6 car_image">
            @foreach($cars as $car)
                @if($car->id == $car_id)
                    <img class="img-responsive" src="{{$car->photo ? $car->photo->file : 'http://via.placeholder.com/200x200'}}" alt="">
                @endif
            @endforeach
        </div>
    </div>

    {{-- Include form-errors file for error checking --}}
    @include('includes.form-errors')
    {!! Form::close() !!}
</div>
@endsection

{{-- Linking some JavaScript code which used in above examples --}}
@section('footer')
    <script>
        var price = $('.car_details .calculate').attr('price');
        var days = $('.car_details .calculate').attr('days');

        var dislocation = 0;
        <?php if($branch_return) { ?>
            <?php if($branch_pickup != $branch_return) { ?>
                dislocation = 80;
            <?php } ?>
        <?php } ?>

        var over_time = 0;
        <?php if($over_time_pickup_cond == 1 || $over_time_return_cond == 1) { ?>
            over_time = <?php echo $over_time; ?>
        <?php }  ?>

        $('.boxgarantie').on('click', function () {

            $('.boxgarantie').removeClass('active');
            $(this).addClass('active');

            $('.buttonrezervaclick b').text('CHOOSE');
            $(this).find('.buttonrezervaclick b').text('CHOSEN');

            protection_name = $(this).find('.panel-title').text();
            $('.car-details-row .garantie-car .warranty-name').text(protection_name);

            protection_price = $(this).find('.the-price .the-price-val').text() * days;
            console.log(protection_price);
            $('.car-details-row .garantie-car .warranty-price').text(protection_price);

            var protection_price = parseInt($('.radio-toolbar .boxgarantie.active').find('.the-price-val').text()) * days;

            var total = (days * price) + dislocation + over_time + protection_price;
            $('input:checkbox:checked').each(function(){
                total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
            });
            var total_price = '<?php echo __('home.Total_price') ?>';

            $('.total').html(total_price + "<span class='pull-right'>" + "£ " + total + "</span>");


        });

        $('.echipamente:checkbox').change(function () {

            var protection_price = parseInt($('.radio-toolbar .boxgarantie.active').find('.the-price-val').text()) * days;

            var total = parseInt((days * price) + dislocation + over_time + protection_price);
            $('input:checkbox:checked').each(function(){
                total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());
            });
            console.log(protection_price);
            var total_price = '<?php echo __('home.Total_price') ?>';

            $('.total').html(total_price + "<span class='pull-right'>" + "£ " + total + "</span>");
        });

        // Extras package: SatNav
        var price6 = $('.echipamentep6').attr('price');
        var service6 = $( ".titleechipament6" ).text();
        $("#echipamente6").click(function() {
            if($('#echipamente6').is(':checked')) {
                $( "#fulloptions" ).append( '<p class="service6">' + service6 + " x " +days + ' <?php echo __('home.Day_s') ?> ' + "<strong class='pull-right'>" + "£ " + ( price6 * days ) +  '</p>' );
            } else {
                $( ".service6" ).remove();
            }
        });
        
        // Extras package: Baby Seat
        var price5 = $('.echipamentep5').attr('price');
        var service5 = $( ".titleechipament5" ).text();
        $("#echipamente5").click(function() {
            if($('#echipamente5').is(':checked')) {
                $( "#fulloptions" ).append( '<p class="service5">' + service5 + " x " +days + ' <?php echo __('home.Day_s') ?> ' + "<strong class='pull-right'>" + "£ " + ( price5 * days ) +  '</p>' );
            } else {
                $( ".service5" ).remove();
            }
        });
        // Extras package: Child Seat
        var price4 = $('.echipamentep4').attr('price');
        var service4 = $( ".titleechipament4" ).text();
        $("#echipamente4").click(function() {
            if($('#echipamente4').is(':checked')) {
                $( "#fulloptions" ).append( '<p class="service4">' + service4 + " x " +days + ' <?php echo __('home.Day_s') ?> ' + "<strong class='pull-right'>" + "£ " + ( price4 * days ) +  '</p>' );
            } else {
                $( ".service4" ).remove();
            }
        });

        /*for(var i = 1; i<=5; i++) {
            var price_var = $('price' + i);
            var echipamentep_identi = $('.echipamentep' + i);

            var service_var = $('service' + i);
            var titleechipament_identi = $('.titleechipament' + i);

            var echipamente1_identi = $('#echipamente' + i);

            var service_identi = $('#service' + i);

            price_var = $(echipamentep_identi).attr('price');
            service_var = $( titleechipament_identi ).text();
            $(echipamente1_identi).click(function() {
                if($(echipamente1_identi).is(':checked')) {
                    $( "#fulloptions" ).append( '<p class="'+service_identi+'">' + service_var + " x " +days + ' <?php echo __('home.Day_s') ?> ' + "<strong class='pull-right'>" + ( price_var * days ) + " $</strong>" +  '</p>' );
                } else {
                    $( service_var ).remove();
                }
            });

        }*/
    </script>
@stop