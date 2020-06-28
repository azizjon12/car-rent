<?php

namespace App\Http\Controllers;

use App\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Gettig all the Car types by showing them a view of cars/types/index
        $types = CarType::all();
        return view('cars.types.index',compact('types'));
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
        // Storing a newly created Car type
        $input = $request->all();
        CarType::create($input);
        // then, Redirecting to cars/types page
        return redirect('/cars/types');
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
        // Editing a car type by getting its id
        $type = CarType::findOrFail($id);
        // Then, return that page
        return view('cars.types.edit',compact('type'));
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
        // Updating a newly edited car type
        $input = $request->all();
        $type = CarType::findOrFail($id);
        $type->update($input);
        // Redirecting to cars/types page
        return redirect('/cars/types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Before deleting a car type, we get its id
        $input = CarType::findOrFail($id);
        // Deleting a car type
        $input->delete();
        // Redirecting to cars/types page
        return redirect('/cars/types');
    }
}
