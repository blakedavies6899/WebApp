@extends('layouts.app')

@section('title', 'posts')

<style>


.pad {
      padding-top: 5px;
      padding-bottom: 5px
    }

.center {
  text-align: center;
}
</style>

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

<div class = "container" style = "width: 300px;">
    <h1 class = "center"> Posts </h1>


    @foreach ($posts as $post)
    <div class = "pad">
        <div  class = "card" style = "width: 300px; margin: auto; background-color: blue; color: white;" onclick="location.href='{{route('postDetails',['id'=>$post->id])}}'">
        @if($post->image != 'empty.jpg')
            <img src="{{ URL::to('images') }}/{{$post->image}}" class = "center" style = "height: 200px;"></img>
        @endif
            <p class = "center" >{{$post->title}}</p>
            <small class = "center" >{{$post->user->name}}</small>
        </div>
            @endforeach

        <div class = "pad">
            <button type="button" class ="btn btn-primary" onclick="location.href='createPosts'">Create post</button>
        </div>
    </div>
</div>

{{$posts->links()}}
@endsection
