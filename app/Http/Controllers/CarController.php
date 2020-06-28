<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Branch;
use App\Car;
use App\CarFuel;
use App\Http\Requests\CarCreateRequest;
use App\Photo;
use App\CarType;
use App\CarGearbox;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting all list of Cars by returning a view of cars/index
        $cars = Car::all();
        return view('cars.index',compact ('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // In order to create a Car, we need to pluck Car's fuel, car and transmission types
        // And a Branch where the Car will be available for renting
        $fuels = CarFuel::pluck('name','id')->all();
        $types = CarType::pluck('name','id')->all();
        $gearboxes = CarGearbox::pluck('name','id')->all();
        $branches = Branch::pluck('name','id')->all();
        return view('cars.create', compact('fuels', 'types', 'branches', 'gearboxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarCreateRequest $request)
    {
        // Storing all the information. 
        // If there is a photo file, we will add timestamp to its name and store it
        $input = $request->all();;
        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('public/images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }
        Car::create($input);
        return redirect('/cars');
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
        // Same for Editing the Car
        // We pluck CarFuel, CarType, CarGearbox and Branch models
        $car = Car::findOrFail($id);
        $fuels = CarFuel::pluck('name','id')->all();
        $types = CarType::pluck('name','id')->all();
        $gearboxes = CarGearbox::pluck('name','id')->all();
        $branches = Branch::pluck('name','id')->all();
        return view('cars.edit',  compact('car', 'fuels', 'types', 'branches', 'gearboxes'));
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
        $car = Car::findOrFail($id);
        $input = $request->all();
        // Checking whether a photo been uploaded
        if($file = $request->file('photo_id')) {
            // If yes, changing it's name
            $name = time() . $file->getClientOriginalName();
            // Moving to public/images
            $file->move('public/images', $name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }
        $car->update($input);
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // For Deleting a Car, will get its id
        $car = Car::findOrFail($id);
        //unlink(public_path() . $car->photo->file);
        // Deleting the Car
        $car->delete();
        // Redirecting to cars page
        return redirect('/cars');
    }
}
