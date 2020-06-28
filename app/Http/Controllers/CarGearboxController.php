<?php

namespace App\Http\Controllers;

use App\CarGearbox;
use Illuminate\Http\Request;

class CarGearboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting all the CarGearboxes
        $gearboxes = CarGearbox::all();
        // Showing them by returning a view of cars/gearboxes/index
        return view('cars.gearboxes.index',compact('gearboxes'));
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
        // Storing a newly created CarGearbox type
        $input = $request->all();
        CarGearbox::create($input);
        // Redirecting to cars/gearboxes page
        return redirect('/cars/gearboxes');
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
        // Editing Car Transmission type by showing a view of cars/gearboxes/edit
        $gearbox = CarGearbox::findOrFail($id);
        return view('cars.gearboxes.edit',compact('gearbox'));
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
        // Updating a Car Transmission type by getting its id
        $input = $request->all();
        $gearbox = CarGearbox::findOrFail($id);
        $gearbox->update($input);
        // Redirecting to cars/gearboxes page
        return redirect('/cars/gearboxes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Getting an id of Car Transmission type before deleting
        $input = CarGearbox::findOrFail($id);
        // Deleting it
        $input->delete();
        // Redirecting to cars/gearboxes page
        return redirect('/cars/gearboxes');
    }
}
