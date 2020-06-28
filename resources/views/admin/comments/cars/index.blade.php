{{-- In this file we will create a view for All Cars  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    {{-- First we will check whether we have cars by writing an if  statement. 
        If the number of cars is greater than 0, then  we will list them by their ID numbers --}}
    @if(count($cars) > 0)
        <h1>{!! trans('home.All') !!} {!! trans('home.Cars') !!}</h1>
        <table class="table-responsive-design">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    {{-- <th scope="col">{!! trans('home.Image') !!}</th> --}}
                    <th scope="col">{!! trans('home.PRICE') !!}</th>
                    <th scope="col">{!! trans('home.details') !!}</th>
                    <th scope="col">Extras</th>
                    <th scope="col">{!! trans('home.AVAILABLE') !!}</th>
                </tr>
            </thead>
            <tbody>
            @if($cars)
                {{-- Foreach loops is been used to list all the Cars --}}
                @foreach($cars as $car)
                    <tr>
                        <td data-label="ID">{{$car->id}}</td>
                        {{-- When you click on the name of the Car it takes you 
                            to the Edit page which is located at views/cars/edit 
                            where you can either Edit or Delete the Car details --}}
                        <td valign="center" data-label="Name"><a href="{{route('cars.edit', $car->id)}}">{{$car->name}}</a></td>
                        {{-- <td data-label="{!! trans('home.Image') !!}"><img height="50" src="{{$car->photo ? $car->photo->file : 'http://via.placeholder.com/200x200'}}" alt=""></td> --}}
                        <td data-label="{!! trans('home.PRICE') !!}">{{$car->daily_price}}$</td>
                        {{-- This small table will display all the other details of the car, 
                            such as transmission and fuel types, number of doors and etc.  --}}
                        <td data-label="{!! trans('home.details') !!}" align="left" width="90%"><a data-toggle="popover" data-trigger="click" data-content="<table class='table table-bordered'>
                                       <tr>
                                        <td>{!! trans('home.Car') !!} {!! trans('home.Type') !!}:</td><td>{{$car->type->name}}</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.Air_Conditioning') !!}:</td> <td> {{ ($car->ac == 1) ? 'Yes' : 'No' }} </td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.Transmission') !!}:</td> <td>{{$car->gearbox->name}}</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.no.') !!} {!! trans('home.Passengers') !!}:</td> <td>{{ $car->num_passengers }}</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.no.') !!} {!! trans('home.Doors') !!}:</td> <td>{{ $car->num_doors }}</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.no.') !!} {!! trans('home.Suitcases') !!}:</td> <td>{{ $car->bags_capacity }}</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.Location') !!}:</td> <td>{{ $car->branch->location }}</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.Fuel') !!} {!! trans('home.Type') !!}:</td> <td>{{ $car->fuel->name }}</td>
                                       </tr>
                                       <tr>
                                        <td>Additional Info:</td> <td>{{ $car->aditional_info }}</td>
                                       </tr>
                                       </table>" title="Details" data-html="true" class="btn btn-info">{!! trans('home.details') !!}</a>
                        </td>
                        {{-- This small table will display all the Extras, Car-Rent has to 
                            offer with the car, such as SatNav, Baby and Child seats --}}
                        <td data-label="Optional Equipment:" align="left" width="80%"><a data-toggle="popover" data-trigger="click" data-content="<table class='table table-bordered'>
                                       <tr>
                                        <td>{!! trans('home.SATNAV') !!} {!! trans('home.price') !!}:</td> <td>{{$car->satnav}}$</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.Child_Seat') !!} {!! trans('home.price') !!}:</td> <td>{{$car->baby_seat}}$</td>
                                       </tr>
                                       <tr>
                                        <td>{!! trans('home.Baby_Seat') !!} {!! trans('home.price') !!}:</td> <td>{{$car->child_seat}}$</td>
                                       </tr>
                                       </table>" title="Extras" data-html="true" class="btn btn-info">Extras</a>
                        </td>
                        {{-- This form is responsible for the availability of the Car.
                            You can easily disable/show the Car to customers to rent --}}
                        <td data-label="Available">
                            {{-- If is_available is equal to 0 (zero), it means Car IS NOT availabe to rent --}}
                            @if($car->is_available == 0)
                                {!! Form::model($car, ['method' => 'PATCH', 'action' => ['CarController@update', $car->id] ]) !!}
                                <input type="hidden" name="is_available" value="1">
                                {!! Form::submit(Lang::get('home.Yes'), ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            {{-- On the other hand, if is_available is equal to 1 (one), it means Car IS availabe to rent --}}
                            @elseif($car->is_available == 1)
                                {!! Form::model($car, ['method' => 'PATCH', 'action' => ['CarController@update', $car->id] ]) !!}
                                <input type="hidden" name="is_available" value="0">
                                {!! Form::submit(Lang::get('home.Not'), ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        
    {{-- If there is not a Car, then we will print out that there are not Cars Available --}}
    @else
        <h1>{!! trans('home.Not') !!} {!! trans('home.Cars') !!}</h1>
    @endif
@endsection

{{-- Here we include a Bootstrap Popover plugin  which halps us to display 
    information effectively in a way of a small table --}}
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection