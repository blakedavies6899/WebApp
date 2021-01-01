@extends('layouts.app')

@section('title', 'posts')

<style>
.pad {
      padding: 10px
    }
</style>

@section('content')
<form action="{{route('UpdatePost')}}" method="POST"  enctype="multipart/form-data">

    @csrf
    <div class = "pad">
        <button type="button" class = "btn btn-primary" onclick="location.href='/posts'">Back To Posts</button>
    </div>
    <input id="id" name = "id" type="hidden", value= "{{$post->id}}">

    <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" max="30" placeholder="Add Title Here" value="{{ $post->title }}" required autofocus>

    <textarea id="mainbody" name="mainbody" rows="13" class="form-control @error('mainbody') is-invalid @enderror" placeholder="Add Main Body Here" value="{{ $post->mainbody }}" required>{{$post->mainbody}}</textarea>

    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" >
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class = "pad">
        <button type="submit" class = "btn btn-primary">Save Post</button>
    </div>
</form>
<div class = "pad">
    <button onclick="document.location='{{route('postDelete',['id'=>$post->id])}}'" class = "btn btn-primary">Delete Post</button>
</div>
@endsection