<!--extend layout master.blade.php -->
@extends('layouts.master')

<!--sets value for section title to "Mini Twitter" (section title is used in messages.blade.php) -->
@section('title', 'Mini Twitter')

<!--starts section content, defines some html for section content and end section content
ts value for section title to "Mini Twitter" (section content is used in messages.blade.php) -->
@section('content')

@section('content')
<h2>Message Details:</h2>

<h4><b>{{$message->title}}</b></h4>
<h3>{{$message->content}}</h3>
<p>By: <b>{{ $message->user->name }}</b></p>
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
    <button type="button" class="btn btn-secondary mt-3" onclick="window.location='/message/{{$message->id}}'">Cancel</button>
</form>



<form action="/message/{{$message->id}}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-circlesmall mt-3 text-center"><i class="fa-solid fa-trash-can fa-2x fa-flip" style="--fa-animation-duration: 30s; --fa-animation-iteration-count: 1;"></i></button></div>
  </form>
@endsection
