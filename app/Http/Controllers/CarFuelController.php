<?php

namespace App\Http\Controllers;

use App\CarFuel;
use Illuminate\Http\Request;

class CarFuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting all the CarFuels
        $fuels = CarFuel::all();
        // Showing them by returning a view of cars/fuels/index
        return view('cars.fuels.index',compact('fuels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Storing a newly created CarFuel type
        $input = $request->all();
        CarFuel::create($input);
        //Redirecting to cars/fuels page
        return redirect('/cars/fuels');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Editing CarFuel
        $fuel = CarFuel::findOrFail($id);
        return view('cars.fuels.edit',compact('fuel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Updating Car's Fuel type
        $input = $request->all();
        $fuel = CarFuel::findOrFail($id);
        $fuel->update($input);
        //Redirecting to cars/fuels page
        return redirect('/cars/fuels');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Getting CarFuel's id
        $input = CarFuel::findOrFail($id);
        // Deleting a Fuel type
        $input->delete();
        // Redirecting to cars/fuels page
        return redirect('/cars/fuels');
    }
}
