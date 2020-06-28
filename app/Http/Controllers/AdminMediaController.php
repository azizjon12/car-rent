<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class AdminMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Showing all the Photos on the page
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Make a request from the database 
        $file = $request->file('file');
        // Creating a new file name, adding timestamp at the beginning of the name
        $name = time() . $file->getClientOriginalName();
        // Moving an image to the public/images folder
        $file->move('public/images', $name);

        // Creating a file
        Photo::create(['file'=>$name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Finding a photo by it's id
        $input = Photo::findOrFail($id);
        // Deleting the photo
        $input->delete();
        // Redirecting to Admin/media page
        return redirect('/admin/media');
    }
}
