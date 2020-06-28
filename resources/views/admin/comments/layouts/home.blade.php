<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Car-Rent | UK Car Rental</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('public/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/img/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('public/img/site.webmanifest')}}">

    <!-- Styles -->
    <link href="{{asset('css/libs/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/libs/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/libs/style.css')}}" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div id="app">
    <nav class="rent-zone-nav navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('public/img/logo-carrent.png')}}" alt="Car-Rent logo">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{url('/')}}">{!! trans('home.rent_a_car_menu') !!}</a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}"> {!! trans('home.login') !!}</a></li>
                        <li><a href="{{ route('register') }}"> {!! trans('home.register') !!}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    @if(Auth::user()->role)
                                        @if(Auth::user()->role->name == 'customer')
                                            <a href="{{ route('user.user-profile') }}">My Profile</a>
                                        @endif
                                        @if(Auth::user()->role->name == 'administrator')
                                            <a href="{{ url('/admin/users') }}/{{Auth::user()->id}}/edit">{!! trans('home.My_Profile') !!}</a>
                                        @endif
                                    @endif
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {!! trans('home.logout') !!}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

                    {{-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {!! trans('home.language') !!} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/settings/lang/en">{!! trans('home.english') !!}</a></li>
                            <li><a href="/settings/lang/de">{!! trans('home.german') !!}</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    {{-- <div class="band pawb">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <ul class="nav nav-justified nopadding">
                        <li>
                            <div class="sliderbuttons nopadding">
                                <i class="fa fa-check bbb" aria-hidden="true"></i> {!! trans('home.new_vehicles') !!}
                            </div>
                        </li>
                        <li>
                            <div class="sliderbuttons nopadding" href="#">
                                <i class="fa fa-check bbb" aria-hidden="true"></i> {!! trans('home.city_free_delivery') !!}
                            </div>
                        </li>
                        <li>
                            <div class="sliderbuttons nopadding" href="#">
                                <i class="fa fa-check bbb" aria-hidden="true"></i> {!! trans('home.reservation_and_road_assistance') !!}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container why-us">
        <h1 class="homepagetitle text-center">{!! trans('home.why_choose_us') !!}</h1>
        <div class="col-md-4">
            <div class="icon-box">
                <div class="icon">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                </div>
                <div class="icon-text">
                    <h4 class="title heading-font"> {!! trans('home.outstanding_services') !!}</h4>
                    <div class="content">
                        <p>We provide outstanding services for our customers. Our services are approved by hundreds of satisfied customers. Customers mean everything for us.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="icon-box">
                <div class="icon">
                    <i class="fa fa-trophy" aria-hidden="true"></i>
                </div>
                <div class="icon-text">
                    <h4 class="title heading-font"> {!! trans('home.quality_vehicles') !!}</h4>
                    <div class="content">
                        <p>All our Vehicles are frequently checked for their Quality. Quality of the cars are Car-Rent’s top priority. Witness our Quality of cars by reserving a car for your next trip with us.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="icon-box">
                <div class="icon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                </div>
                <div class="icon-text">
                    <h4 class="title heading-font"> {!! trans('home.satnav_every_vehicle') !!}</h4>
                    <div class="content">
                        <p>In order to make your trip as comfortable as possible, we offer Satellite Navigation for every car that we provide. You can easily set the place you want to go to and you are ready to go.</p>
                        {{-- <p>Lorem ipsum dolor sit amet, adipiscing elit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas lobortis vestibulum ipsum vitae pellentesque.</p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="icon-box">
                <div class="icon">
                    <i class="fa fa-child" aria-hidden="true"></i>
                </div>
                <div class="icon-text">
                    <h4 class="title heading-font"> {!! trans('home.baby_child_seats') !!}</h4>
                    <div class="content">
                        <p>As an additional comfort for our customers, we offer variety of seats such as Child and Baby seats. You can take you kids to a trip without worrying about the seats.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="icon-box">
                <div class="icon">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                </div>
                <div class="icon-text">
                    <h4 class="title heading-font"> {!! trans('home.at_mn_transmission') !!}</h4>
                    <div class="content">
                        <p>In order to make our cars available to our customers, we provide cars with Manual and Automatic transmissions. You can choose them on the reservation process.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="icon-box">
                <div class="icon">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                </div>
                <div class="icon-text">
                    <h4 class="title heading-font"> {!! trans('home.24_Hours_Support') !!}</h4>
                    <div class="content">
                        <p>Rest easy knowing that the Car-Rent community is pre-screened, and customer support and roadside assistance are just a click away.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer id="footer-main">
    <div class="container">
        <div class="col-md-3">
            <h6>{!! trans('home.ABOUT') !!} <span>Car-Rent</span></h6>
            <div class="text">
                <p>Car-Rent is your local car rental system. Our Headquarters located in Brighton, East Sussex.</p>
                <br>
            </div>
        </div>
        <div class="col-md-3">
            <h6>{!! trans('home.CONTACT') !!}</h6>
            <div class="text">
                <p><span>{!! trans('home.Phone') !!}: </span> <a href="tel:01273 123 456">01273 123 456</a></p>
                {{-- <p><span>Car-Rent {!! trans('home.office') !!} 2:</span> (888) 637-7262</p> --}}
                <p><span>Email:</span> <a href="mailto:info@car-rent.me">info@car-rent.me</a></p>
                <br>
            </div>
        </div>
        <div class="col-md-3">
            {{-- <h6>{!! trans('home.branch_hours') !!}</h6> --}}
            <h6>Our Working Hours</h6>
            <div class="text">
                <p><span>{!! trans('home.Monday') !!} - {!! trans('home.Sunday') !!}:</span> 08:00 - 18:00</p>
            </div>
        </div>
        {{-- <div class="col-md-3">
            <h6>{!! trans('home.SOCIAL_NETWORK') !!}</h6>
            <div class="socials_wrapper">
                <ul class="socials_lists">
                    <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li> <a href="#" target="_blank"> <i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div> --}}
    </div>
</footer>
<!-- Scripts -->
<script src="{{ asset('public/js/libs/jquery-2.1.4.js') }}"></script>
<script src="{{ asset('public/js/libs/bootstrap.min.js') }}"></script>
@yield('footer')
</body>
</html>
