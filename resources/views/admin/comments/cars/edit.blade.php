{{-- In this file we will create a view for Editing and Deleting a Car  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')

    <h1>{!! trans('home.Update') !!} {!! trans('home.Car') !!} </h1>
    {{-- Here is the section for displaying an image of the Car
        If an image is not been Uploaded, it will show a default image following the below link --}}
    <div class="text-left">
        <img class="img-responsive" style="margin-bottom: 50px;max-width:400px" src="{{$car->photo ? $car->photo['file'] : 'http://via.placeholder.com/400x400'}}" alt="">
    </div>

    <div style="margin-bottom: 50px;" class="row">
        <div class="col-md-6">
            {{-- Here we call update method of the CarController which 
                is responsible for updating a Car details --}}
            {!! Form::model($car, ['method' => 'PATCH', 'action' => ['CarController@update', $car->id], 'files'=>true]) !!}
            {{-- Name of the Car --}}
            <div class="form-group">
                {!! Form::label('name', Lang::get('home.Name')) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Car type ie Compact, Standard or Premium --}}
            <div class="form-group">
                {!! Form::label('type_id', Lang::get('home.Type')) !!}
                {!! Form::select('type_id', [''=> 'Choose type'] + $types, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Does Car have Air Conditioning --}}
            <div class="form-group">
                {!! Form::label('ac', Lang::get('home.Air_Conditioning')) !!}
                {!! Form::select('ac', ['1'=> 'Yes', '0'=> 'No'], null, ['class' => 'form-control']) !!}
            </div>
            {{-- Transmission type of the Car --}}
            <div class="form-group">
                {!! Form::label('gearbox_id', Lang::get('home.Transmission')) !!}
                {!! Form::select('gearbox_id', [''=> 'Choose gearbox'] + $gearboxes, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Number of passengers can locate inside the Car --}}
            <div class="form-group">
                @php($no_passe = Lang::get('home.no_of') . ' ' . Lang::get('home.Passengers'))
                {!! Form::label('num_passengers', $no_passe) !!}
                {!! Form::text('num_passengers', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Number of doors Car have --}}
            <div class="form-group">
                @php($no_doors = Lang::get('home.no_of') . ' ' . Lang::get('home.Doors'))
                {!! Form::label('num_doors', $no_doors) !!}
                {!! Form::text('num_doors', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Number of suitcases can take in --}}
            <div class="form-group">
                @php($no_suitcases = Lang::get('home.no_of') . ' ' . Lang::get('home.Suitcases'))
                {!! Form::label('capacity', $no_suitcases) !!}
                {!! Form::text('capacity', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Additional information --}}
            <div class="form-group">
                {!! Form::label('aditional_info', 'Additional Info:') !!}
                {!! Form::textarea('aditional_info', null, ['class' => 'form-control', 'rows'=>'5']) !!}
            </div>
            {{-- Price of the Car per day --}}
            <div class="form-group">
                @php($day_price = Lang::get('home.Price') . '/' . Lang::get('home.Day') . ' (£)')
                {!! Form::label('daily_price', $day_price) !!}
                {!! Form::text('daily_price', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-md-6">
            {{-- Price for an Extra SatNav --}}
            <div class="form-group">
                @php($optional_satnav_price = Lang::get('home.Extra') . ' ' . Lang::get('home.SATNAV') . ' ' . Lang::get('home.Price'))
                {!! Form::label('satnav', $optional_satnav_price) !!}
                {!! Form::text('satnav', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Price for an Extra Child Seat --}}
            <div class="form-group">
                @php($optional_CHILD_SEAT_price = Lang::get('home.Extra') . ' ' . Lang::get('home.Child_Seat') . ' ' . Lang::get('home.Price'))
                {!! Form::label('baby_seat', $optional_CHILD_SEAT_price) !!}
                {!! Form::text('baby_seat', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Price for an Extra Baby Seat --}}
            <div class="form-group">
                @php($optional_BABY_SEAT_price = Lang::get('home.Extra') . ' ' . Lang::get('home.Baby_Seat') . ' ' . Lang::get('home.Price'))
                {!! Form::label('child_seat', $optional_BABY_SEAT_price) !!}
                {!! Form::text('child_seat', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Branch of the Car --}}
            <div class="form-group">
                {!! Form::label('branch_id', Lang::get('home.Branche')) !!}
                {!! Form::select('branch_id', [''=> 'Choose branch'] + $branches, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Car's fuel type --}}
            <div class="form-group">
                {!! Form::label('fuel_id', Lang::get('home.Fuel_type')) !!}
                {!! Form::select('fuel_id', [''=> 'Choose fuel'] + $fuels, null, ['class' => 'form-control']) !!}
            </div>
            {{-- Selecting an image for the Car --}}
            <div class="form-group">
                {!! Form::label('photo_id', Lang::get('home.Image')) !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>
            {{-- Button for "Update Car" function --}}
            <div class="form-group">
                @php($update_car = Lang::get('home.Update') . ' ' . Lang::get('home.Car') )
                {!! Form::submit($update_car, ['class' => 'btn btn-primary']) !!}
            </div>

            {{-- Include form-errors file for error checking --}}
            @include('includes.form-errors')

            {!! Form::close() !!}

            {{-- Here we call destroy method of the CarController which is
            responsible for Deleting the specific Car --}}
            {!! Form::open(['method' => 'DELETE', 'action' => ['CarController@destroy', $car->id]]) !!}
            {{-- Button for "Delete Car" function --}}
            <div class="form-group">
                {!! Form::submit(Lang::get('home.Delete') . ' ' . Lang::get('home.Car'), ['class' => 'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection