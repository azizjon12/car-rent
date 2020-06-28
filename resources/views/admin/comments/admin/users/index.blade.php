{{-- In this file we will create a view for Users  --}}

{{-- Extending a layouts/admin view because this file is only available for admins.
    layouts/admin has specific lines of code for Admin Panel use only --}}
@extends('layouts.admin')

{{-- Below is the content of the Page --}}
@section('content')
    <div id="yield-page" class="users-page">
        <h1>All Users</h1>

        {{-- Including Sessions for changes which have been made --}}
        @if(Session::has('deleted_user'))
            <div class="alert alert-success" role="alert">
                <p>{{session('deleted_user')}}</p>
            </div>

        @elseif(Session::has('updated_user'))
            <div class="alert alert-success" role="alert">
                <p>{{session('updated_user')}}</p>
            </div>

        @elseif(Session::has('created_user'))
            <div class="alert alert-success" role="alert">
                <p>{{session('created_user')}}</p>
            </div>

        @endif

        {{-- Creating a responsive table to display All the Users --}}
        <table class="table-responsive-design">
            <thead>
            <tr>
                <th scope="col">ID</th>
                {{-- <th scope="col">Photo</th> --}}
                <th scope="col">Full Name</th>
                <th scope="col">Details</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>

            </tr>
            </thead>
            <tbody>

            @if($users)
            {{-- Foreach loops is been used to list all the Branches --}}
                @foreach($users as $user)
                    <tr>
                        <td data-label="ID">{{$user->id}}</td>
                        {{-- <td data-label="{!! trans('home.Photo') !!}"><img height="60" src="{{$user->photo ? $user->photo->file : 'http://via.placeholder.com/200x200'}}" alt=""></td> --}}
                        
                        {{-- When you click on the name of the User it takes you 
                                to the Edit page which is located at views/admin/users/edit
                                where you can either Edit or Delete a User --}}
                        <td data-label="{!! trans('home.Name_and_Surname') !!}"><a href="{{ route('admin.users.edit', $user->id) }}">{{$user->name}}</td></a>

                        <td data-label="Info" align="left" width="90%"><a data-toggle="popover" data-trigger="click" data-content="<table class='table table-bordered'>
                                       <tr>
                                        <td>Address:</td><td>{{$user->address}}</td>
                                       </tr>
                                       <tr>
                                        <td>Postcode:</td><td>{{$user->postcode}}</td>
                                       </tr>
                                       <tr>
                                        <td>City:</td><td>{{$user->city}}</td>
                                       </tr>
                                       <tr>
                                        <td>Phone:</td><td>{{$user->phone}}</td>
                                       </tr>
                                       </table>" title="More Details" data-html="true" class="btn btn-info">Info</a>
                        </td>
                        <td data-label="Email">{{$user->email}}</td>
                        <td data-label="Role">{{$user->role ? $user->role->name : 'User has no role'}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection

{{-- Here we include a Bootstrap Popover plugin which helps us to display information 
    effectively in a way of a small table  --}}
@section('footer')
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover();
        });
    </script>

    <script>
        if($('#yield-page').hasClass('user-page')) {
            $('.cd-side-nav > ul > .users').addClass('active');
        }
    </script>
@endsection