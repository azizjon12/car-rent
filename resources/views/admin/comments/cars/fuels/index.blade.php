{{-- In this file we will create a view for Car Fuels  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use --}}
@extends('layouts.admin')

{{-- Below is the content of the page --}}
@section('content')
{{-- First we will check whether we have fuel types by writing an if  statement. 
    If the number of the fuel type is greater than 0, then  we will list them by their ID numbers --}}
    @if(count($fuels) > 0)
    <div class="col-md-6">
        <h1>{!! trans('home.All') !!} {!! trans('home.Fuel_type') !!}</h1>
        <table class="table-responsive-design">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">{!! trans('home.CREATED') !!}</th>
                    <th scope="col">{!! trans('home.UPDATED') !!}</th>
                </tr>
            </thead>
            <tbody>
            @if($fuels)
                {{-- Foreach loop is been used to list every fuel type --}}
                @foreach($fuels as $fuel)
                    <tr>
                        <td data-label="ID">{{$fuel->id}}</td>
                        {{-- When you click on the name of the Fuel type it takes you 
                                to the Edit page which is located at views/cars/fuels/edit 
                                where you can either Edit or Delete the Fuel type --}}
                        <td data-label="Name"><a href="{{ route('cars.fuels.edit', $fuel->id) }}">{{$fuel->name}}</a></td>
                        <td data-label="{!! trans('home.CREATED') !!}">{{$fuel->created_at ? $fuel->created_at->diffForHumans() : 'no date'}}</td>
                        <td data-label="{!! trans('home.UPDATED') !!}">{{$fuel->updated_at ? $fuel->updated_at->diffForHumans() : 'no date'}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    {{-- If there is not a Fuel type, then we will print out that there is not a Fuel type --}}
    @else
        <h1>{!! trans('home.Not') !!} {!! trans('home.Type_of_fuel') !!}</h1>
    @endif

    {{-- Here, we will include a section for Creating a Fuel type.
        We could easily create a separate file for it. 
        However, we will just include it here beacuse it is only several lines of code  --}}
    <div class="col-md-6">
        <h1>{!! trans('home.Create') !!} {!! trans('home.Fuel_type') !!}</h1>

        {{-- Here we call store method of the CarFuelController which stores all the Fuel types --}}
        {!! Form::open(['method' => 'POST', 'action' => 'CarFuelController@store']) !!}
        {{-- Name of the Fuel Type --}}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Button for "Create Fuel Type" --}}
        <div class="form-group">
            @php($create_fuel = Lang::get('home.Create') . ' ' . Lang::get('home.Fuel_type') )
            {!! Form::submit($create_fuel, ['class' => 'btn btn-primary']) !!}
        </div>

        {{-- Just in case include form-errors file for error checking --}}
        @include('includes.form-errors')
        {!! Form::close() !!}
    </div>
@endsection