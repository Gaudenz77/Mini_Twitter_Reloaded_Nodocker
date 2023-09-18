<!--extend layout master.blade.php -->
@extends('layouts.master')

<!--sets value for section title to "Mini Twitter" (section title is used as yield in messages.blade.php) -->
@section('title', 'Mini Twitter Reloaded with LARAVEL Breeze')

<!--starts section content, defines the title for the section and also defines some html for section content
(html is between section... and endsection) section content is used as yield in messages.blade.php) -->
@section('content')

    <div class="container">
        <!-- Dashboard and Logout button -->
        <div class="row justify-content-end mt-3">
            {{--         <div class="col-auto">
            @auth
                <p style="line-height: 50px">Welcome <b>{{ Auth::user()->name }}</b> </p>
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                <form class="text-center" action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf<br>
                    <button type="submit" class="btn btn-circlesmall mt-3"><i class="fa-solid fa-right-from-bracket fa-2x fa-flip" style="--fa-animation-iteration-count: 1;"></i></button>
                </form>
                <x-button-test />
            @else
                <a href="{{ route('login') }}" class="">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="">Register</a>
                @endif
            @endauth
        </div>
    </div> --}}

            <!-- Blog Post Form and Blog Messages -->
            <div class="row">
                <!-- Blog Post Form -->
                <div class="col-md-4">
                    @if (Auth::check())
                        <h2 style="line-height: 50px">Create newer message test: </h2>
                        <form action="/create" method="post">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="title" value="{{-- {{$message->title}} --}}"
                                    placeholder="Title" id="floatingInput" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea"
                                    style="height: 100px" required>{{-- {{ $message->content }} --}}</textarea>
                                <input type="hidden" value="0" name="like_count">
                                <input type="hidden" value="0" name="dislike_count">
                            </div>
                            @csrf
                            <div class="sender text-center">
                                <button type="submit" class="btn btn-circle mt-3 text-center"><i
                                        class="fa-brands fa-twitter fa-3x fa-flip"
                                        style="--fa-animation-duration: 30s; --fa-animation-iteration-count: 1;"></i></button>
                            </div>
                        </form>
                    @else
                        <h4>Please <a href="{{ route('login') }}">login</a> or <a
                                href="{{ route('register') }}">register</a><br>to post a message.</h4>
                    @endif
                </div>

                <!-- Blog Messages -->
                <div class="col-md-8">
                    <img src="./assetsown/img/hqdefault.jpg" style="width:100px; height: auto;">
                    <h2 style="line-height: 50px">Recent messages:</h2>
                    <ul>
                        @forelse($messagesList as $message)
                            <!-- Loop through messages and display them -->
                            <li class="messagesList {{-- bg-info mb-3 --}}mt-2">
                                <a href="/message/{{ $message->id }}">
                                    <b>{{ $message->title }}:</a></b><br>
                                <p>{{ $message->content }}</p>
                                <div class="form-icons mx-2 md-mx-auto">
                                    <form action="/message/{{ $message->id }}/like" method="POST" class="">
                                        @csrf
                                        <input type="hidden" name="message_id" value="{{ $message->id }}">
                                        <input type="hidden" value="0" name="like_count">
                                        <button type="submit" class="transparent-btn-up"><i
                                                class="fas fa-thumbs-up"></i></button>
                                    </form>
                                    {{ $message->like_count }}
                                    <form action="/message/{{ $message->id }}/dislike" method="POST" class="">
                                        @csrf
                                        <input type="hidden" name="message_id" value="{{ $message->id }}">
                                        <input type="hidden" value="0" name="dislike_count">
                                        <button type="submit" class="transparent-btn-down" style="margin-left: 15px;"><i
                                                class="fas fa-thumbs-down"></i></button>
                                    </form>
                                    {{ $message->dislike_count }}
                                </div><br>
                                <!-- comment display start-->
                                <!-- link to comment page-->
                                @if (Auth::check())
                                    <a href="/message/{{ $message->id }}">Authenticated users can write
                                @endif
                                <b>Comments:</b></a><br>
                                @forelse ($message->comments as $comment)
                                    <figure class="comment">
                                        <blockquote class="comment-content">
                                            {{ $comment->comment }}
                                        </blockquote>
                                        <figcaption class="comment-info blockquote-footer">
                                            <span class="comment-author"><i><b>{{ $comment->user->name }}</i></b></span>
                                            <span class="comment-date">, {{ $comment->created_at->diffForHumans() }}</span>
                                        </figcaption>
                                    </figure>
                                @empty
                                    <p>No comments yet!</p>
                                @endforelse
                                <div class="editor mb-2 py-3">
                                    @auth
                                        <form class="text-center" action="/message/{{ $message->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-circlesmallest mt-3"><i
                                                    class="fa-solid fa-trash-can"
                                                    style="--fa-animation-duration: 30s; --fa-animation-iteration-count: 1;"></i></button>
                                        </form>
                                    @endauth
                                    @if ($message->user)
                                        <p class="createdAt"><i><b>{{ $message->user->name }}</i></b>,
                                            {{ $message->created_at->diffForHumans() }}</p>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li class="messagesList">No messages yet.</li>
                        @endforelse
                    </ul>
                    <div class="text-end"><b class="text-end">Date: {{ date('d.m.Y') }}</b></div>
                </div>
            </div>
        </div>

        <!-- message form end -->
    @endsection
