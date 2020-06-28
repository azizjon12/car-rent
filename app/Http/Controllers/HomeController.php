<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
        // @if(Auth::user()->role)
        //     @if(Auth::user()->role->name == 'customer')
        //         <a href="{{ route('user.user-profile') }}">My Profile</a>
        //     @endif
        //     @if(Auth::user()->role->name == 'administrator')
        //         <a href="{{ url('/admin/users') }}/{{Auth::user()->id}}/edit">{!! trans('home.My_Profile') !!}</a>
        //      @endif
        // @endif


        // Checking whether a User is an Admin or a Customer
        $role_id = auth()->user()->role_id;
        $user = User::find($role_id);

        // If an Admin, redirect to 'home' page
        if($role_id == '1') {
            return view('home');
        }
        // Else redirect to Customer's Profile page
        else {
            return view('user.user-profile');
        }
    }

    // This is been used for Localisation of an application
    public function changeLanguage($locale)
    {
        Session::set('locale', $locale);
        return back();
    }
}
