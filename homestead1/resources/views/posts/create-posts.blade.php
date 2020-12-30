@extends('layouts.app')

@section('title', 'posts')

@section('content')
<form action="{{route('postCreate')}}" method="POST"  >

    @csrf

    <input id="title" type="text" name="title" class="form-control @error('title') is-invalid @enderror" max="30" placeholder="Add Title Here" value="{{ old('title') }}" required autofocus>

    <textarea id="mainbody" name="mainbody" rows="13" class="form-control @error('mainbody') is-invalid @enderror" placeholder="Add Main Body Here" value="{{ old('mainbody') }}" required></textarea>

    <label for="Tags">Choose a tag:</label>
    <select name="tags[]"  multiple>
    @foreach($tags as $tag)
    <option value='{{$tag->id}}'>{{$tag->mainbody}} </option>
    @endforeach
  </select>
  
  <br><br>

    <button type="submit">Create post</button>

</form>
@endsection