<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsRepliesController extends Controller
{
    // Creating a function for replies
    public function createReply(Request $request)
    {
        // Authenticating a user
        $user = Auth::user();
        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo->file,
            'body' => $request->body,
        ];
        CommentReply::create($data);
        $request->session()->flash('reply_message', 'Reply has been submitted and it is awaiting for moderation');
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
        // Showing comment replies by returning a view of admin/comments/replies/show
        $comment = Comment::findOrFail($id);
        $replies = $comment->replies;
        return view('admin.comments.replies.show',compact('replies'));
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
        // Updating a comment reply
        $reply = CommentReply::findOrFail($id);
        $input = $request->all();
        $reply->update($input);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Deleting a comment reply by its id
        $reply = CommentReply::findOrFail($id);
        $reply->delete();
        // Redirecting back
        return redirect()->back();
    }
}
