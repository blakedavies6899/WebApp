@extends('layouts.app')

@section('title', 'posts')

<style>
.pad {
      padding: 10px
    }
</style>

@section('content')


<form action="{{route('postCreate')}}" method="POST" enctype="multipart/form-data" >

    @csrf
    <div class ="pad">
        <button type="button" style = "pad" onclick="location.href='posts'"class = "btn btn-primary">Back to Posts</button>
    </div>
    <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" max="30" placeholder="Add Title Here" value="{{ old('title') }}" required autofocus>

    <textarea id="mainbody" name="mainbody" rows="13" class="form-control @error('mainbody') is-invalid @enderror" placeholder="Add Main Body Here" value="{{ old('mainbody') }}" required></textarea>

    <label for="Tags">Choose a tag:</label>
    <select name="tags[]"  multiple>
        @foreach($tags as $tag)
        <option value='{{$tag->id}}'>{{$tag->mainbody}} </option>
        @endforeach
    </select>

    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  
  <br><br>
    <div class = "pad">
        <button type="submit" class = "btn btn-primary">Create post</button>
    </div>

</form>
@endsection