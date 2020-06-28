{{-- In this file we will create a view for Car Transmission  --}}

{{-- Extending a layouts/admin view because this file is only available for Admins.
    layouts/admin has specific lines of code for Admin Panel use --}}
@extends('layouts.admin')

{{-- Below is the content of the page --}}
@section('content')
    {{-- First we will check whether we have transmission/gearbox types by writing an if 
        statement. If the number of transmission/gearbox type is greater than 0, then 
        we will list them by their ID numbers --}}
    @if(count($gearboxes) > 0)
    <div class="col-md-6">
        <h1>{!! trans('home.All') !!} {!! trans('home.Transmission') !!}</h1>
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
                @if($gearboxes)
                    {{-- Foreach loop is been used to list every transmission type --}}
                    @foreach($gearboxes as $gearbox)
                        <tr>
                            <td data-label="ID">{{$gearbox->id}}</td>
                            {{-- When you click on the name of the Transmission type it takes you 
                                to the Edit page which is located at views/cars/gearboxes/edit
                                where you can either Edit or Delete the Transmission type --}}
                            <td data-label="Name"><a href="{{ route('cars.gearboxes.edit', $gearbox->id) }}">{{$gearbox->name}}</a></td>
                            <td data-label="{!! trans('home.CREATED') !!}">{{$gearbox->created_at ? $gearbox->created_at->diffForHumans() : 'no date'}}</td>
                            <td data-label="{!! trans('home.UPDATED') !!}">{{$gearbox->updated_at ? $gearbox->updated_at->diffForHumans() : 'no date'}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- If there is not a transmission type, then we will print out that there is not transmission type --}}
    @else
        <h1>{!! trans('home.No') !!} {!! trans('home.Transmission') !!}</h1>
    @endif

    {{-- Here, we will include a section for Creating a Transmission type.
        We could easily create a separate file for it. 
        However, we will just include it here beacuse it is only several lines of code  --}}
    <div class="col-md-6">
        <h1>{!! trans('home.Create') !!} {!! trans('home.Transmission') !!}</h1>

        {{-- Here we call index method of the CarGearnoxController which lists all the Transmission types --}}
        {!! Form::open(['method' => 'POST', 'action' => 'CarGearboxController@index']) !!}
        {{-- Name of the Transmission Type --}}
        <div class="form-group">
            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
        {{-- Button for "Create Transmission" --}}
        <div class="form-group">
            {!! Form::submit('Create Transmission', ['class' => 'btn btn-primary']) !!}
        </div>

        {{-- Just in case include form-errors file for error checking --}}
        @include('includes.form-errors')
        {!! Form::close() !!}
    </div>
@endsection