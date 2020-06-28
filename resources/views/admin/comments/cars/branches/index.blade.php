{{-- In this file we will create a view for Branches  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    {{-- First we will check whether we have Branches by writing an if 
        statement. If the number of Branches is greater than 0, then 
        we will list them by their ID numbers --}}
    @if(count($branches) > 0)
        <div class="col-md-8">
            <h1>{!! trans('home.All') !!} {!! trans('home.Branches') !!}</h1>
            <table style="margin-bottom:50px" class="table-responsive-design">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{!! trans('home.Name') !!}</th>
                        <th scope="col">Email</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                @if($branches)
                    {{-- Foreach loops is been used to list all the Branches --}}
                    @foreach($branches as $branch)
                        <tr>
                            <td data-label="ID">{{$branch->id}}</td>
                            {{-- When you click on the name of the Branch it takes you 
                                to the Edit page which is located at views/cars/branches/edit
                                where you can either Edit or Delete the Branch --}}
                            <td data-label="{!! trans('home.Name') !!}"><a href="{{route('cars.branches.edit', $branch->id)}}">{{$branch->name}}</a></td>
                            <td data-label="Email">{{$branch->email}}</td>
                            <td data-label="Info" align="left" width="90%"><a data-placement="bottom" data-toggle="popover" data-trigger="click"  data-content="<table class='table table-bordered'>
                               <tr>
                                <td>{!! trans('home.Address') !!}:</td><td>{{$branch->address}}</td>
                               </tr>
                               <tr>
                                <td>{!! trans('home.Location') !!}:</td><td>{{$branch->location}}</td>
                               </tr>
                               <tr>
                                <td>{!! trans('home.Phone') !!}:</td><td>{{$branch->phone}}</td>
                               </tr>
                               </table>" title="More Details" data-html="true" class="btn btn-info">Info</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    {{-- If there is not any Branch, then we will print out that there is Not Branch --}}
    @else
        <h1>{!! trans('home.Not') !!} {!! trans('home.Branches') !!}</h1>
    @endif
@endsection

{{-- Here we include a Bootstrap Popover plugin  which helps us to display information 
    effectively in a way of a small table  --}}
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>
@endsection