

@extends('layouts.app')

@section('title', 'posts')

@section('content')

<button onclick="location.href='/posts'">Back To Posts</button>
<ul>
    <li>Title: {{$post->title}}</li>
    <li>Main Body: {{$post->mainbody}}</li>
    <li>User: {{$post->user->name}}</li>
    @if($user->id == $post->user_id)
    <button onclick="document.location='{{route('postUpdate',['id'=>$post->id])}}'">Edit Post</button>
    @endif
</ul>
<ul>
    @foreach($post->tags as $tags)
        <small class="mb-0">#{{ $tags->mainbody}}</small>
    @endforeach
    @if($post->image != 'empty.png')
                <img src="{{ URL::to('images') }}/{{$post->image}}" alt="Post Image" width="700"><br><br>
    @endif
</ul>

    <div class="card mt-4">
            <h5 class="card-header">Comments <span class="comment-count float-right badge badge-info">{{ count($post->comments) }}</span></h5>
            <div class="card-body">
                {{-- Add Comment --}}
                <div class="add-comment mb-3">
                    @csrf
                    <textarea class="form-control comment" placeholder="Enter Comment"></textarea>
                    <button data-post="{{ $post->id }}" class="btn btn-dark btn-sm mt-2 save-comment">Submit</button>
                </div>
                <hr/>
                {{-- List Start --}}
                <div class="comments"> 
                    @if(count($post->comments)>0)
                        @foreach($post->comments as $comment)
                            <blockquote class="blockquote">
                              <small class="mb-0">{{ $comment->mainbody}}</small>
                            </blockquote>
                            <small class="mb-0">{{ $comment->user->name}}</small>
                            <hr/>
                        @endforeach
                    @else
                    <p class="no-comments">No Comments Yet</p>
                    @endif
                </div>
            </div>
        </div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
// Save Comment
$(".save-comment").on('click',function(){
    var _comment=$(".comment").val();
    var _post=$(this).data('post');
    var _user='<?php echo $user->name;?>';
    var vm=$(this);
    // Run Ajax
    $.ajax({
        url:"{{ url('save-comment') }}",
        type:"post",
        dataType:'json',
        data:{
            comment:_comment,
            post:_post,
            user:_user,
            _token:"{{ csrf_token() }}"
        },
        beforeSend:function(){
            vm.text('Saving...').addClass('disabled');
        },
        success:function(res){
            var _html='<blockquote class="blockquote animate__animated animate__bounce">\
            <small class="mb-0">'+_comment+'</small>\
            </blockquote><hr/>';
            if(res.bool==true){
                $(".comments").prepend(_html);
                $(".comment").val('');
                $(".user").val('');
                $(".comment-count").text($('blockquote').length);
                $(".no-comments").hide();
            }
            vm.text('Save').removeClass('disabled');
        }   
    });
});
</script>

@endsection