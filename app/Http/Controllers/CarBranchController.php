<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Location;
use Illuminate\Http\Request;

class CarBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting all the Branches
        $branches = Branch::all();
        // Returning a view for it, with all the Branches table
        return view('cars.branches.index',compact('branches'));
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // For creating a Branch we return a view of cars/branches/create
        return view('cars.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Storing a newly created Branch
        $input = $request->all();
        Branch::create($input);
        return redirect('/branches');
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
        // To Edit the Branch, we get its id
        //  and return a view of cars/branches/edit
        $branch = Branch::findOrFail($id);
        return view('cars.branches.edit',compact('branch'));
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
        // Updating a Branch
        $input = $request->all();
        $branch = Branch::findOrFail($id);
        $branch->update($input);
        // Then, redirecting to branches page
        return redirect('/branches');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // To Delete the Branch, we get it's id
        $input = Branch::findOrFail($id);
        // Deleting a Branch
        $input->delete();
        // Redirecting to branches page
        return redirect('/branches');
    }
}
