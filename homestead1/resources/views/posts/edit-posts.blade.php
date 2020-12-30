@extends('layouts.app')

@section('title', 'posts')

@section('content')
<form action="{{route('UpdatePost')}}" method="POST"  >

    @csrf


    <input id="id" name = "id" type="hidden", value= "{{$post->id}}">

    <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" max="30" placeholder="Add Title Here" value="{{ $post->title }}" required autofocus>

    <textarea id="mainbody" name="mainbody" rows="13" class="form-control @error('mainbody') is-invalid @enderror" placeholder="Add Main Body Here" value="{{ $post->mainbody }}" required>{{$post->mainbody}}</textarea>

    <button type="submit">Save Post</button>

</form>
<button onclick="document.location='{{route('postDelete',['id'=>$post->id])}}'">Delete Post</button>
@endsection