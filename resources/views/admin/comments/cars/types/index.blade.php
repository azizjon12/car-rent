{{-- In this file we will create a view for Car Types  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use --}}
@extends('layouts.admin')

{{-- Below is the content of the page --}}
@section('content')
    {{-- First we will check whether we have car types by writing an if  statement. 
        If the number of the car type is greater than 0, then  we will list them by their ID numbers --}}
    @if(count($types) > 0)
        <div class="col-md-6">
            <h1>{!! trans('home.All') !!} {!! trans('home.Car') !!} {!! trans('home.Types') !!}</h1>
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
                @if($types)
                {{-- Foreach loop is been used to list every car type --}}
                    @foreach($types as $type)
                        <tr>
                            <td data-label="ID">{{$type->id}}</td>
                            {{-- When you click on the name of the Car type it takes you 
                                to the Edit page which is located at views/cars/types/edit 
                                where you can either Edit or Delete the Car type --}}
                            <td data-label="Name"><a href="{{ route('cars.types.edit', $type->id) }}">{{$type->name}}</a></td>
                            <td data-label="{!! trans('home.CREATED') !!}">{{$type->created_at ? $type->created_at->diffForHumans() : 'no date'}}</td>
                            <td data-label="{!! trans('home.UPDATED') !!}">{{$type->updated_at ? $type->updated_at->diffForHumans() : 'no date'}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    {{-- If there is not a Car type, then we will print out that there is not a Car type --}}
    @else
        <h1>{!! trans('home.Not') !!} {!! trans('home.Car') !!} {!! trans('home.Types') !!}</h1>
    @endif

    {{-- Here, we will include a section for Creating a Car type.
        We could easily create a separate file for it. 
        However, we will just include it here beacuse it is only several lines of code  --}}
    <div class="col-md-6">
        <h1>{!! trans('home.Create') !!} {!! trans('home.Car') !!} {!! trans('home.Type') !!}</h1>
        {{-- Here we call store method of the CarTypeController which stores all the Car types --}}
        {!! Form::open(['method' => 'POST', 'action' => 'CarTypeController@store']) !!}
        {{-- Name of the Car Type --}}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Button for "Create Car Type" --}}
        <div class="form-group">
            @php($create_car_type = Lang::get('home.Create') . ' ' . Lang::get('home.Car') . ' ' . Lang::get('home.Type'))
            {!! Form::submit($create_car_type, ['class' => 'btn btn-primary']) !!}
        </div>
        {{-- Just in case include form-errors file for error checking --}}
        @include('includes.form-errors')
        {!! Form::close() !!}
        </div>
@endsection