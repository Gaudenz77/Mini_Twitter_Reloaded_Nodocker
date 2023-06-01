/* --MessgeController 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;

class MessageController extends Controller
{
    public function showAll() {

        // gets all the entries from table messages
       // and gets an array of objects as a return value.
       // we store this return value in the variable $messages
       $messages = Message::all()->sortByDesc('created_at');

       // This line would output the messages in the UI/Browser
       // and stop the script execution.
       // good for debugging ;o)
       //dd($messages);

       // This function retursn a view.
       // here the blade template engine works its magic again
       // through which we cann pass the $messages array to the view.
       // we can pass it as an optional second paramter (
 // associative array)
 $messages = Message::with('user')->orderByDesc('created_at')->get();
       return view('messages', ['messagesList' => $messages]);
    }

    public function create(Request $request) {

        // we create a new Message-Object
        $message = new Message();
        // we set the properties title and content
        // with the values that we got in the post-request
        $message->title = $request->title;
        $message->content = $request->content;
        $message->like_count = $request->like_count;
        $message->dislike_count = $request->dislike_count;
        $message->user_id = $request->user()->id;
      
        // we save the new Message-Object in the messages
        // table in our database
        $message->save();
   
        // at the end we make a redirect to the url /messages
        // return redirect('/messages');        

        return redirect('/messages');        
    }

    public function details($id) {

        // ask the database for the message with the ID that we got
        // as a parameter. It is the same ID that we used to
        // generate the links to the message details
        // and the same ID that web.php took out of the link and
        // "passed it on" to the controller   
        $message = Message::findOrFail($id);
       
        // we return the view messageDetails.blade.php
        // and we also pass it the Message-Object that we got
        // back from the function findOrFail   
        return view('messageDetails', ['message' => $message]);
    }
 
    public function delete($id) {

        // ask the database for the message with the ID that we got
        // as a parameter. It is the same ID that we used to
        // generate the links to the message details
        // and the same ID that web.php took out of the link.
        // then we directly call the delete-method of
        // the Message-OBject that we get back from the
        // findOrFail function.
        $result = Message::findOrFail($id)->delete();
 
        // after that we redirect to the message list again  
        return redirect('/messages');        
        /* return redirect('/'); */        
    }

    public function like(Request $request) {
        $message = Message::findOrFail($request->message_id);
        $message->increment('like_count');
        return redirect('/messages');
    }
    
    public function dislike(Request $request) {
        $message = Message::findOrFail($request->message_id);
        $message->increment('dislike_count');
        return redirect('/messages');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
    
}

/* ------------------------------------------------ */

