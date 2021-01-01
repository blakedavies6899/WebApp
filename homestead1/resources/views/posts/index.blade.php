@extends('layouts.app')

@section('title', 'posts')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <p> Posts <p>

    <ul>
        @foreach ($posts as $post)
            <li onclick="location.href='{{route('postDetails',['id'=>$post->id])}}'">{{$post->title}}</li>
        @endforeach
        
    </ul>
    <button type="button" onclick="location.href='createPosts'">Create post</button>
    {{$posts->links()}}
@endsection