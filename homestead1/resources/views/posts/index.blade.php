@extends('layouts.app')

@section('title', 'posts')

<style>
.pad {
      padding: 10px
    }
</style>

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <p> Posts <p>

    <ul>
        @foreach ($posts as $post)
            <li onclick="location.href='{{route('postDetails',['id'=>$post->id])}}'">{{$post->title}}</li>
        @endforeach
        
    </ul>
    <div class = "pad">
        <button type="button" class ="btn btn-primary" onclick="location.href='createPosts'">Create post</button>
    </div>
    {{$posts->links()}}
@endsection