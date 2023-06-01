{{-- 
<!--extend layout master.blade.php -->
@extends('layouts.master')

<!--sets value for section title to "Mini Twitter" (section title is used as yield in messages.blade.php) -->
@section('title', 'Mini Twitter')

<!--starts section content, defines the title for the section and also defines some html for section content
(html is between section... and endsection) section content is used as yield in messages.blade.php) -->
@section('content')

@if (Route::has('login'))
    <div class="col-sm-2">
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <br><button type="submit" class="btn btn-circlesmall mt-3 text-center"><i class="fa-solid fa-right-from-bracket fa-2x fa-flip" style="--fa-animation-iteration-count: 1;"></i></button>
            </form>
            
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
        @endauth
    </div>
@endif

<div class="col-sm-4">
    <h2>Create new message: </h2>
    <form action="/create" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" name="title" placeholder="Title" id="floatingInput" required>
            <label for="floatingInput">Title</label>
        </div>
       <div class="form-floating">
        <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px" required></textarea>
        <label for="floatingTextarea">Comments</label>
        <input type="hidden" value="0" name="like_count">
        <input type="hidden" value="0" name="dislike_count">
       </div>
       <!-- this blade directive is necessary for all form posts somewhere in between the form tags -->
       @csrf
       <div class="sender text-center">
        <button type="submit" class="btn btn-circle mt-3 text-center"><i class="fa-brands fa-twitter fa-3x fa-flip" style="--fa-animation-duration: 30s; --fa-animation-iteration-count: 1;"></i></button></div>
    </form>
</div>

<div class="col-sm-6">
    <h2 style="line-height: 50px">Recent messages:</h2>
    <ul>
    <!-- loops through the $messages, that this blade template
       gets from MessageController.php. for each element of the loop which
       we call $message we print the properties (title, content
       and created_at in an <li> element -->
    @foreach ($messagesList as $message)
    <li class="messagesList">
        <b><a href="/message/{{$message->id}}">{{$message->title}}:</a></b><br>
        {{$message->content}} 
        <div class="form-icons mx-2 md-mx-auto">
                <form action="/message/{{$message->id}}/like" method="POST" class="">
                    @csrf
                    <input type="hidden" name="message_id" value="{{$message->id}}">
                    <input type="hidden" value="0" name="like_count">
                    <button type="submit" class="transparent-btn-up" ><i class="fas fa-thumbs-up"></i></button>
                </form>
                    {{$message->like_count}}
                <form action="/message/{{$message->id}}/dislike" method="POST" class="">
                    @csrf
                    <input type="hidden" name="message_id" value="{{$message->id}}">
                    <input type="hidden" value="0" name="dislike_count">
                    <button type="submit" class="transparent-btn-down" style="margin-left: 15px;"><i class="fas fa-thumbs-down"></i></button>
                </form>
                    {{$message->dislike_count}}
                    <p class="createdAt">By: <b>{{ $message->user->name }}</b> , {{$message->created_at->diffForHumans()}}</p>         
        </div>

        <p class="createdAt">By: <b>{{ $message->user->name }}</b>, {{$message->created_at->diffForHumans()}}</p>

        <!-- Nested loop for displaying the replies of each message -->
        @if ($message->replies && count($message->replies) > 0)
            <ul>
                @foreach ($message->replies as $reply)
                    <li>
                        <b>Reply by {{ $reply->user->name }}:</b> {{$reply->content}}
                    </li>
                @endforeach
            </ul>
        @endif

        <!-- Form for replying to the message -->
        <form action="/message/{{$message->id}}/reply" method="POST" class="mt-3">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="title" placeholder="Title" required>
                <label for="floatingInput">Title</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="content" placeholder="Leave a reply here" style="height: 100px" required></textarea>
                <label for="floatingTextarea">Reply</label>
            </div>
            <input type="hidden" name="message_id" value="{{$message->id}}">
            <button type="submit" class="btn btn-primary mt-3">Reply</button>
        </form>
    </li>
@endforeach
    </ul>
</div>

<div class="text-end"><b>Date: {{date('d.m.Y')}}</b></div>

@endsection


/* --------------------------------works below without reply feature ------ ------ */

@foreach ($messagesList as $message) 
        <li class="messagesList">
            <b><a href="/message/{{$message->id}}">{{$message->title}}:</a></b><br>
                {{$message->content}} 
            <div class="form-icons mx-2 md-mx-auto">
                <form action="/message/{{$message->id}}/like" method="POST" class="">
                    @csrf
                    <input type="hidden" name="message_id" value="{{$message->id}}">
                    <input type="hidden" value="0" name="like_count">
                    <button type="submit" class="transparent-btn-up" ><i class="fas fa-thumbs-up"></i></button>
                </form>
                    {{$message->like_count}}
                <form action="/message/{{$message->id}}/dislike" method="POST" class="">
                    @csrf
                    <input type="hidden" name="message_id" value="{{$message->id}}">
                    <input type="hidden" value="0" name="dislike_count">
                    <button type="submit" class="transparent-btn-down" style="margin-left: 15px;"><i class="fas fa-thumbs-down"></i></button>
                </form>
                    {{$message->dislike_count}}
                    <p class="createdAt">By: <b>{{ $message->user->name }}</b> , {{$message->created_at->diffForHumans()}}</p>
            </div>               
        </li>
    @endforeach

    /*  -------------------------------- works above without reply feature -------------------------------- */

    @if ($message->replies && count($message->replies) > 0)

    /*  -------------------------------- like/dislike feature -------------------------------- */

    <div class="form-icons mx-2 md-mx-auto">
        <form action="/message/{{$message->id}}/like" method="POST" class="">
            @csrf
            <input type="hidden" name="message_id" value="{{$message->id}}">
            <input type="hidden" value="0" name="like_count">
            <button type="submit" class="transparent-btn-up" ><i class="fas fa-thumbs-up"></i></button>
        </form>
            {{$message->like_count}}
        <form action="/message/{{$message->id}}/dislike" method="POST" class="">
            @csrf
            <input type="hidden" name="message_id" value="{{$message->id}}">
            <input type="hidden" value="0" name="dislike_count">
            <button type="submit" class="transparent-btn-down" style="margin-left: 15px;"><i class="fas fa-thumbs-down"></i></button>
        </form>
            {{$message->dislike_count}}
            <p class="createdAt">By: <b>{{ $message->user->name }}</b> , {{$message->created_at->diffForHumans()}}</p>         
    </div>
/* ---------------------------------------------------------------- */
<form action="/message/{{$message->id}}/reply" method="POST" class="mt-3">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                    <label for="floatingInput">Title</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" name="content" placeholder="Leave a reply here" style="height: 100px" required></textarea>
                    <label for="floatingTextarea">Reply</label>
                </div>
                <input type="hidden" name="message_id" value="{{$message->id}}">
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="collapse" data-bs-target="#replyForm{{$message->id}}" aria-expanded="false" aria-controls="replyForm{{$message->id}}">Reply</button>
            </form>


            ----------------------------------------------------------------

            public function reply($id) {
        // retrieve the message with the given ID
        $message = Message::findOrFail($id);
        // pass the message object to the view
        return view('replyMessage', ['message' => $message]);
    }






<!-- toggle mode script start -->
 <script>
      function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
      }
 </script>
<!-- toggle mode script end-->

 --}}