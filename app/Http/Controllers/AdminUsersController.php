<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Photo;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting All the Users from a Database
        $users = User::all();
        // Redirecting to admin/users/index page
        return view('admin.users.index',compact ('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Creating a User from an Admin Panel
        // We will pluck/show a Role model for deciding the role of a user
        $roles = Role::pluck('name','id')->all();
        // Redirecting to admin/user/create page
        return view('admin.users.create', compact('roles'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // Creating a flash session for an Admin to notice the change
        Session::flash('created_user', 'The user has been created');
        // Passing everything to the Database except password field
        if(trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            // We will bcrypt() the password and save this version to the Database
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        // Checking whether we have a photo_id
        if($file = $request->file('photo_id')) {
            // Creating a file name with insertion of timestamp to it
            $name = time() . $file->getClientOriginalName();
            // Moving the file to public/images folder
            $file->move('public/images', $name);
            // Creating a file with the filename
            $photo = Photo::create(['file'=>$name]);
            // Taking the current photo_id from photo table and putting it into users table
            $input['photo_id'] = $photo->id;
        }
        // Creating a User and redirecting to admin/users page
        User::create($input);
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Returning a view of users
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Getting a User id and it's role
        //  changing the fields we would like to change
        //  then, we need to go to update method
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit',compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        // Creaating a flash session
        //  Updating a user's information
        Session::flash('updated_user','The user has been updated');
        $user = User::findOrFail($id);
        // Passing everything except password field
        if(trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            // We will bcrypt() the password and save this version to the Database
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }
        if($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('public/images',$name);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }
        $user->update($input);
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Flash session
        Session::flash('deleted_user','The user has been deleted');

        // Finding id of the User
        $user = User::findOrFail($id);
        //unlink(public_path() . $user->photo->file);
        //Deleting a User
        $user->delete();
        // Redirecting to admin/users page
        return redirect('/admin/users');
    }
}
