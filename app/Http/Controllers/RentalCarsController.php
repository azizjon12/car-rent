<?php

namespace App\Http\Controllers;

use App\Branch;
use App\CarGearbox;
use App\CarType;
use App\Car;
use App\Http\Requests\ChooseCarRequest;
use App\Http\Requests\SearchCarRequest;
use App\Photo;
use App\RentalCar;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RentalCarsController extends Controller
{
    public function search(Request $request)
    {
        // Displaying a view of rent-a-car/search-car for selecting the locations
        $branches = Branch::pluck('location', 'id')->all();
        return view('rent-a-car.search-car',compact('branches')   );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Displaying a car-reservations view
        return redirect('/car-reservations');
    }

    public function display()
    {
        // Displaying all the rental cars by returning a view of rent-a-car/index page
        $rentalcars = RentalCar::all();
        return view('rent-a-car.index',compact('rentalcars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function choose_car(SearchCarRequest $request)
    {
        // Getting all these instances to show a car for a user to choose from
        $cars = Car::all();
        $branch_pickup = Input::get('branch_pickup', false);
        $branch_return = Input::get('branch_return', false);
        $pickupDate = Input::get('pickupDate', false);
        $returnDate = Input::get('returnDate', false);
        $pickupTime = Input::get('pickupTime', false);
        $returnTime = Input::get('returnTime', false);
        $branches = Branch::all();
        $transmissions  = CarGearbox::all();
        $types  = CarType::all();
        //Returning a view of choose-car with all these detailes just selected
        return view('rent-a-car.choose-car',
            compact('cars', 'branches', 'transmissions', 'types', 'branch_pickup', 'branch_return', 'pickupDate', 'returnDate', 'pickupTime', 'returnTime'));
    }

    public function additional_services(ChooseCarRequest $request)
    {
        // Getting all these instances to show additionale_services(Extra protections) 
        //  for a user to choose from
        $cars = Car::all();
        $branches = Branch::all();
        $branch_pickup = Input::get('branch_pickup', false);
        $branch_return = Input::get('branch_return', false);
        $pickupDate = Input::get('pickupDate', false);
        $returnDate = Input::get('returnDate', false);
        $pickupTime = Input::get('pickupTime', false);
        $returnTime = Input::get('returnTime', false);
        $car_id = Input::get('car_id', false);
        // Returning a view of additional-services with all these detailes just selected
        return view('rent-a-car.additional-services',
            compact('cars', 'branches', 'branch_pickup', 'branch_return', 'pickupDate', 'returnDate', 'pickupTime', 'returnTime','car_id'));
    }
    public function final_step()
    {
        // Getting all these instances to show final-step for a confirmation of the reservation
        $cars = Car::all();
        $branch_pickup = Input::get('branch_pickup', false);
        $branch_return = Input::get('branch_return', false);
        $pickupDate = Input::get('pickupDate', false);
        $returnDate = Input::get('returnDate', false);
        $pickupTime = Input::get('pickupTime', false);
        $returnTime = Input::get('returnTime', false);
        $car_id = Input::get('car_id', false);
        $garantie = Input::get('garantie', false);
        $branches = Branch::all();
        $car_satnav = Input::get('car_satnav', false);
        $car_baby_seat = Input::get('baby_seat', false);
        $car_child_seat = Input::get('child_seat', false);
        // Returning a view of final-step with all these detailes just selected
        //   like dates and location, car, extra protections and others
        return view('rent-a-car.final-step',
            compact('cars', 'branches', 'branch_pickup', 'branch_return', 'pickupDate', 'returnDate', 'pickupTime', 'returnTime','car_id', 'garantie',
                'car_satnav', 'car_baby_seat', 'car_child_seat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function store(Request $request)
    {
        // Creating a flash session after completing reservation process
        Session::flash('created_reservation_car', '');
        $input = $request->all();

        // If a user has already been registered show their details
        if($user = Auth::user()) {
            $user = Auth::user();
        } else {
            // Else, get all these information from a new User
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'city' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);;

            $name = $request->name;
            $email = $request->email;
            $city = $request->city;
            $phone = $request->phone;
            $role_id = '2';
            $password = bcrypt($request->password);
            $user = User::create(['name'=>$name, 'email'=>$email, 'city'=>$city, 'phone'=>$phone, 'role_id'=>$role_id, 'password'=>$password]);
            Auth::login($user);
        }
        // After completing reservation redirect to completed reservation
        $user->rentalcars()->create($input);
        return redirect('/completed-reservation');
    }

    public function completed_reservation() {
        return view('rent-a-car.completed-reservation');
    }

    /* Customer Profile*/

    public function user_profile() {
        return view('user.user-profile');
    }

    public function user_edit() {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.user-edit',compact ('user'));
    }

    public function user_update(Request $request) {

        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $input = $request->all();
        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return redirect('/user/my-account');
    }

    public function user_reservations() {
        $rentalcars = RentalCar::all();
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.user-reservations',compact ('user','rentalcars'));
    }

    /* profil client */

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
        //
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
        $rentalcars = RentalCar::FindOrFail($id);
        $input = $request->all();
        $rentalcars->update($input);
        return redirect('/car-reservations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
