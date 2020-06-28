<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostsCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting all the posts by showing a view of admin/comment/index page
        $comments = Comment::all();
        return view('admin.comments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Creating a flash message
        Session::flash('comment_message','The comment is waiting for aprovel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Storing a newly created post with the User details
        $user = Auth::user();
        $data = [
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->file,
            'body' => $request->body,
        ];

        Comment::create($data);
        $request->session()->flash('comment_message', 'Comment has been submitted and it is awaiting for moderation');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Showing a post by its id and displaying a view of admin/comments/show page
        $post = Post::FindOrFail($id);
        $comments = $post->comments;
        return view('admin.comments.show', compact('comments'));
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
        // Updating a newly edited Post
        $comment = Comment::FindOrFail($id);
        $input = $request->all();
        $comment->update($input);
        // Redirecting to admin/comments page
        return redirect('/admin/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Deleting a Post by getting its id
        $comment = Comment::FindOrFail($id);
        $comment->delete();
        // Redirecting to admin/comments page
        return redirect('/admin/comments');
    }
}
