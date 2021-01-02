

@extends('layouts.app')

@section('title', 'posts')


@section('content')

<style>
    * {
      box-sizing: border-box;
    }

    .pad {
        padding-top: 5px;
        padding-bottom: 5px
    }
    .editPopup {
      position: relative;
      text-align: center;
      width: 100%;
    }
    .formPopup {
      display: none;
      position: fixed;
      left: 45%;
      top: 5%;
      transform: translate(300%, 200%);
      border: 3px solid #999999;
      z-index: 9;
    }
    .formContainer {
      max-width: 300px;
      padding: 20px;
      background-color: #fff;
    }
    .formContainer input[type=text]{
      width: 100%;
      padding: 15px;
      margin: 5px 0 20px 0;
      border: none;
      background: #eee;
    }
    .formContainer input[type=text]:focus{
      background-color: #ddd;
      outline: none;
    }
    .formContainer .btn:hover,
    .openButton:hover {
      opacity: 1;
    }
</style>
<div class = "pad">
    <button class = "btn btn-primary" onclick="location.href='/posts'">Back To Posts</button>
</div>
<ul>
    <li>Title: {{$post->title}}</li>
    @if($post->image != 'empty.jpg')
        <img src="{{ URL::to('images') }}/{{$post->image}}" alt="Post Image" width="700"><br><br>
    @endif
    
    <li>Main Body: {{$post->mainbody}}</li>
    <li>User: {{$post->user->name}}</li>
    @if($user->id == $post->user_id || $user->role == 'admin')
        <div class = "pad">
            <button class= "btn btn-primary" onclick="document.location='{{route('postUpdate',['id'=>$post->id])}}'">Edit Post</button>
        </div>
    @endif
</ul>
<ul>
    @foreach($post->tags as $tags)
        <small class="mb-0">#{{ $tags->mainbody}}</small>
    @endforeach
    
</ul>

    <div class="card mt-4">
            <h5 class="card-header">Comments <span class="comment-count float-right badge badge-info">{{ count($post->comments) }}</span></h5>
            <div class="card-body">
                {{-- Add Comment --}}
                <div class="add-comment mb-3">
                    @csrf
                    <textarea class="form-control comment" placeholder="Enter Comment"></textarea>
                    <button data-post="{{ $post->id }}" class="btn btn-primary">Submit</button>
                </div>
                <hr/>
                <div class="comments"> 
                    @if(count($post->comments)>0)
                        @foreach($post->comments as $comment)
                            <blockquote class="blockquote">
                              <small class="mb-0">{{ $comment->mainbody}}</small>
                            </blockquote>
                            <small class="mb-0">{{ $comment->user->name}}</small>

                            @if($user->id == $comment->user_id || $user->role == 'admin')
                                <button type="button" class="btn btn-primary" onclick="openForm({{$comment}})">Edit Comment</button>
                            @endif
                            <div class="editPopup">
                                        <div class="formPopup" id="popupForm">
                                            <div class="card">
                                                <h2>Edit Comment</h2><br>
                                                <textarea class="form-control comment" id="pre_edit_content" placeholder="Enter Comment"></textarea><br>
                                                <input type="hidden" id="comment_id" class="form-control comment_id">
                                                <button data-post="{{ $post->id }}"  class="btn btn-primary editComment">Submit</button><br>
                                                <button type="button" class="btn cancel btn-danger" onclick="closeForm()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
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
// save comment
$(".save-comment").on('click',function(){
    var _comment=$(".comment").val();
    var _post=$(this).data('post');
    var _user='<?php echo $user->name;?>';
    var vm=$(this);
//Ajax
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
            location.reload();
        }   
    });
});

//edit comment
$(".editComment").on('click',function(){
    var _comment=$("#pre_edit_content").val();
    var _commentId=$(".comment_id").val();
    var _user='<?php echo $user->name;?>';
    var vm=$(this);

    $.ajax({
        url:"{{ url('editComment') }}",
        type:"put",
        dataType:'json',
        data:{
            comment:_comment,
            commentId:_commentId,
            user:_user,
            _token:"{{ csrf_token() }}"
        },
        beforeSend:function(){
            vm.text('Saving...').addClass('disabled');
        },
        success:function(res){
            vm.text('Save').removeClass('disabled');
            location.reload();
        }   
    });
});

function openForm(comment) {
        $("#comment_id").val(comment.id);
        $("#pre_edit_content").val(comment.mainbody);
        document.getElementById("popupForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("popupForm").style.display = "none";
    }
</script>

@endsection