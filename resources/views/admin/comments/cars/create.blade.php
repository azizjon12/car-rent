{{-- In this file we will create a Create view for Cars  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    <h1>{!! trans('home.Create') !!} {!! trans('home.Car') !!}</h1>

    {{-- Here we call store method of the CarController which stores all the Cars --}}
    {!! Form::open(['method' => 'POST', 'action' => 'CarController@store', 'files'=>true]) !!}

    {{-- Include form-errors file for error checking --}}
    @include('includes.form-errors')
    <div class="row">
        <div class="col-md-6">
            {{-- Name of the Car --}}
            <div class="form-group">
                {!! Form::label('name', Lang::get('home.Name')) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Type of the newly Creating Car --}}
            <div class="form-group">
                {!! Form::label('type_id', Lang::get('home.Type')) !!}
                {!! Form::select('type_id', [''=> 'Choose type'] + $types, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Does a Car have Air Conditioning --}}
            <div class="form-group">
                {!! Form::label('ac', Lang::get('home.Air_Conditioning')) !!}
                {!! Form::select('ac', ['1'=> 'Yes', '0'=> 'No'], null, ['class' => 'form-control']) !!}
            </div>
            {{-- Transmission type of the Car --}}
            <div class="form-group">
                {!! Form::label('gearbox_id', Lang::get('home.Transmission')) !!}
                {!! Form::select('gearbox_id', [''=> 'Choose Transmission'] + $gearboxes, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Number of passenger can locate in the Car --}}
            <div class="form-group">
                @php($no_passe = Lang::get('home.no_of') . ' ' . Lang::get('home.Passengers'))
                {!! Form::label('num_passengers', $no_passe) !!}
                {!! Form::text('num_passengers', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Number of doors of the Car --}}
            <div class="form-group">
                @php($no_doors = Lang::get('home.no_of') . ' ' . Lang::get('home.Doors'))
                {!! Form::label('num_doors', $no_doors) !!}
                {!! Form::text('num_doors', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Number of suitcases can take into the Car --}}
            <div class="form-group">
                @php($no_suitcases = Lang::get('home.no_of') . ' ' . Lang::get('home.Suitcases'))
                {!! Form::label('capacity', $no_suitcases) !!}
                {!! Form::text('capacity', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Additional information of the Car --}}
            <div class="form-group">
                {!! Form::label('aditional_info', 'Additional Info:') !!}
                {!! Form::textarea('aditional_info', null, ['class' => 'form-control', 'rows'=>'5']) !!}
            </div>
            {{-- What will be the daily price of the Car --}}
            <div class="form-group">
                @php($day_price = Lang::get('home.Price') . ' / ' . Lang::get('home.Day') . ' (£)')
                {!! Form::label('daily_price', $day_price) !!}
                {!! Form::text('daily_price', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">
            {{-- Setting a price for an Extra SatNav --}}
            <div class="form-group">
                @php($optional_satnav_price = Lang::get('home.Extra') . ' ' . Lang::get('home.SATNAV') . ' ' . Lang::get('home.price'))
                {!! Form::label('satnav', $optional_satnav_price) !!}
                {!! Form::text('satnav', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Setting a price for an Extra Child Seat --}}
            <div class="form-group">
                @php($optional_CHILD_SEAT_price = Lang::get('home.Extra') . ' ' . Lang::get('home.Child_Seat') . ' ' . Lang::get('home.price'))
                {!! Form::label('baby_seat', $optional_CHILD_SEAT_price) !!}
                {!! Form::text('baby_seat', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Setting a price for an Extra Baby Seat --}}
            <div class="form-group">
                @php($optional_BABY_SEAT_price = Lang::get('home.Extra') . ' ' . Lang::get('home.Baby_Seat') . ' ' . Lang::get('home.price'))
                {!! Form::label('child_seat', $optional_BABY_SEAT_price) !!}
                {!! Form::text('child_seat', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Loacating a Car to the specific Branch --}}
            <div class="form-group">
                {!! Form::label('branch_id', Lang::get('home.Branche')) !!}
                {!! Form::select('branch_id', [''=> 'Choose branch'] + $branches, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Fuel type of the Car --}}
            <div class="form-group">
                {!! Form::label('fuel_id', Lang::get('home.Fuel_type')) !!}
                {!! Form::select('fuel_id', [''=> 'Choose fuel'] + $fuels, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Uploading an image for the Car --}}
            <div class="form-group">
                {!! Form::label('photo_id', Lang::get('home.Image')) !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Button for "Create" a Car --}}
            <div class="form-group">
                @php($create_car = Lang::get('home.Create') . ' ' . Lang::get('home.Car') )
                {!! Form::submit($create_car, ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection