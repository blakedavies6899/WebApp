@extends('layouts.app')

@section('title', 'posts')

<style>


.pad {
      padding-top: 5px;
      padding-bottom: 5px
    }

.colors{
width: 300px;
margin: auto;
color: white;
text-align: center;
}

</style>

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

<div class = "container">
    <div class = "colors">
        <h1 style = "color: black;" class = "center"> Posts </h1>

        @foreach ($posts as $post)<!--displays all of the posts in the posts table on individual cards-->
        <div class = "pad">
            <div  class = "card" style = "width: 300px; margin: auto; background-color: #3E50B4; color: white;" onclick="location.href='{{route('postDetails',['id'=>$post->id])}}'">
            @if($post->image != 'empty.jpg')
                <img src="{{ URL::to('images') }}/{{$post->image}}" class = "center" style = "height: 200px;"></img>
                <!--if the post has an image then show the image, otherwise dont-->
            @endif
                <p class = "center" >{{$post->title}}</p>
                <small class = "center" >{{$post->user->name}}</small>
                <!--display title of the post and user who posted it-->
            </div>
        @endforeach
        <div class = "pad">
            <button type="button" class ="btn btn-primary" onclick="location.href='createPosts'">Create post</button>
        </div>
        </div>
    </div>
</div>
{{$posts->links()}}<!--allows navigation between pages-->
@endsection

