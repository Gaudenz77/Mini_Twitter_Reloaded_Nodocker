<!--extend layout master.blade.php -->
@extends('layouts.master')

<!--sets value for section title to "Mini Twitter" (section title is used in messages.blade.php) -->
@section('title', 'Mini Twitter')

<!--starts section content, defines some html for section content and end section content
ts value for section title to "Mini Twitter" (section content is used in messages.blade.php) -->
@section('content')

@section('content')
@auth
<p style="line-height: 50px">Logged in as: <b>{{ Auth::user()->name}}</b></p>
@endauth
<h4>Message Details:</h4>
<figure>
<blockquote class="blockquote">
    <b>{{$message->title}}</b><br>
{{$message->content}}
@if ($message->user)
</blockquote>
<figcaption class="blockquote-footer">
<b><i> {{ $message->user->name }}</i></b>
, {{$message->created_at->diffForHumans()}}
</figcaption>
</figure>
@endif    
<!-- comment display start-->
@if (Auth::check())
<p><a href="#" class="reply-btn mt-2" data-message-id="{{ $message->id }}">Comment</a></p>
<!-- Comment form start-->
<input type="hidden" id="{{$message->id}}" value="0">
<div  class="reply-container" id="reply-container" style="display: none;">
    <form id="reply-form" action="{{ route('comments.store', ['messageId' => $message->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="parent_id" id="parent-id">
    <div class="form-group col-12 col-lg-4 mb-3">
        <textarea name="content" id="content" class="form-control" rows="3" placeholder="Enter your comment" required></textarea>
    </div>
        <button type="submit" class="btn btn-outline-primary">Comment</button>
        <button type="button" class="btn btn-outline-secondary" id="cancel-btn">Cancel</button>
    </form>
</div>
@endif
<!-- reply form end-->
@forelse ($message->comments as $comment)
    <figure class="comment">
        <blockquote class="comment-content blockquote">
            {{ $comment->comment }}
        </blockquote>
        <figcaption class="comment-info blockquote-footer">
            <span class="comment-author"><b><i>{{ $comment->user->name }},</i></b></span>
            <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
        </figcaption>
    </figure>
@empty
<p>No comments yet!</p> 
@endforelse

<a href="/messages" class="btn btn-circlesmall mt-3 text-center"><i class="fa-solid fa-chevron-left fa-2x fa-flip"></i></a>

@auth
<form class="text-center" action="/message/{{$message->id}}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-circlesmall mt-3 text-center"><i class="fa-solid fa-trash-can fa-2x" style="--fa-animation-duration: 30s; --fa-animation-iteration-count: 1;"></i></button>
</form>   
@endauth

@endsection

