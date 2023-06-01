<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Message;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    /* public function create()
{
    return view('comments.create');
} */
    /**
     * Store a newly created resource in storage.
     */
    /*COMMENTCONTROLLER-METHOD END----------------------------------------------------------------*/

    public function storeComment(Request $request, $messageId)
    {   
        // Validate the request data
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        // Create a new comment
        $comment = new Comment([
            'comment' => $validated['content']
        ]);
            
        $comment->user_id = auth()->user()->id;
        $comment->message_id = $messageId;
        $comment->save();
        
        // Retrieve the message and its comments
        $message = Message::find($messageId);
        $comments = $message->comments()->orderBy('created_at', 'desc')->get();
        
        return view('messageDetails', ['message' => $message, 'comments' => $comments]);
    }


 
}
