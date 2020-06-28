{{-- Extending a main view which is used for accessing the "home" page --}}
@extends('layouts.app')

{{-- Below is the content of the page for someone who entered incorrect path of the website --}}
@section('content')
    <h1 class="text-center">404 Page</h1>
    <h3 class="text-center">Page that you are looking for is not found</h3>
    <h4 class="text-center"><a href="{{url('/')}}">Go Home</a></h4>
@endsection