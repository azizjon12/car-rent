{{-- In this file we will create a view for Home Page which comes with some
    fields that need to be filled by a Customer  --}}

{{-- Extending a layouts/home view because this file is available for the users and guests.
    layouts/home has different structure than layouts/admin --}}
@extends('layouts.home')

{{-- Linking an outside lightweight and powerful datetieme picker  --}}
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

{{-- Below is the content of the Page --}}
@section('content')
    <div class="outer-welcome-vehicle outer-welcome-car">
        <div class="container rent-zone-search">
            <div class="row">
                <div class="col-md-6">
                    {{-- Here we call choose_car method of the RentalCarsController which 
                        is responsible for getting input details from a user/guest --}}
                    {!! Form::open(['method'=>'GET', 'action' => 'RentalCarsController@choose_car' ,'class'=>'rent-zone-search'])  !!}
                    <div class="col-md-12">
                        <h1 class="homepagetitle">Let's find your ideal Car</h1>

                        {{-- Include form-errors file for error checking --}}
                        @include('includes.form-errors')
                    </div>
                    {{-- Pick-up location for car renting --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('branch_pickup', 'Pick-up Location') !!}
                            {!! Form::select('branch_pickup', [''=> 'Choose Pick-up Location'] + $branches, null, ['class' => 'form-control required']) !!}
                        </div>
                    </div>
                    {{-- Return location if it is different from Pick-up location for car renting --}}
                    <div class="col-md-6">
                        <div class="form-group" id="another-location">
                            <div class="checkbox form-control"></div>
                            {!! Form::label('another-location', 'Return to different location', ['id' => 'another-location']) !!}
                        </div>
                        {{-- Return location --}}
                        <div class="form-group hidden branch_return">
                            {!! Form::label('branch_return', 'Return Location') !!}
                            {!! Form::select('branch_return', [''=> 'Choose Return Location'] + $branches, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{-- Pick-up Date for car renting --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pickupDate', 'Pick-up Date') !!}
                                {!! Form::date('pickupDate', null, ['class' => 'form-control rent-date pickupDate required', 'id'=> 'pickupDate']) !!}
                        </div>
                    </div>
                    {{-- Return Date for car renting --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('returnDate', Lang::get('home.Return_Date')) !!}
                            {!! Form::date('returnDate', null, ['class' => 'form-control rent-date returnDate required', 'id'=> 'returnDate']) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{-- Pick-up Time for car renting --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('pickupTime', 'Pick-up Time') !!}
                            {!! Form::time('pickupTime', null, ['class' => 'form-control required']) !!}
                        </div>
                    </div>
                    {{-- Return Time for car renting --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('returnTime', Lang::get('home.Return_Time')) !!}
                            {!! Form::time('returnTime', null, ['class' => 'form-control required', 'id'=> 'returnTime']) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{-- Button for "Search" function --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::submit(Lang::get('home.search'), ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Linking an outside lightweight and powerful datetime picker  --}}
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $("#pickupDate").flatpickr({
            dateFormat: "Y-m-d",
            //dateFormat: "d-m-Y",
            minDate: "today",
            defaultDate: "today"
        });
        $("#returnDate").flatpickr({
        dateFormat: "Y-m-d",
        //dateFormat: "d-m-Y",
        minDate: new Date().fp_incr(1),
        defaultDate: new Date().fp_incr(1),
        });
        $("#pickupTime, #returnTime").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            //time_24hr: true;,
            defaultDate: "10:00",
            minTime: "08:00",
            maxTime: "18:00"
        });
    </script>
    <script>
        $(function(){
            $( "#another-location" ).on("click", function() {
                $( '.branch_return' ).removeClass( "hidden" );
                $(this).addClass( "hidden" );
            });
        });
    </script>
@endsection