<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index',['posts'=> $posts]);
        
    }

    public function viewCreate()
    {
        $tags = Tag::all();
        return view ('posts.create-posts',['tags'=>$tags]);
    }

    public function createPosts(Request $request)
    {
        //valdiation for creating posts
        $request->validate([
            'title'=> 'required',
            'mainbody'=> 'required',
            'image'=> 'mimes:jpeg,jpg,png'
        ]);


        if($request->image !=null)
        {
            $image = $request->file('image');
            $image_name = time().'.'.$image->extension();
            $request->image->move(public_path('images'),$image_name);
        }
        else
        {
            $image_name = 'empty.jpg';
        }

        $user = User::where('id', '=', Auth::guard()->id())->first();//get current user id
        $posts = new Post;
        $posts->title=$request->title;
        $posts->mainbody=$request->mainbody;
        $posts->user_id=$user->id;
        $posts->image = $image_name;
        $posts->save();
        $tag= $request->tags;
        $posts->tags()->attach($tag);
        return redirect('posts');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    //function for showing the details of a post
    {
        $user = User::where('id', '=', Auth::guard()->id())->first();
        $post = Post::findOrFail($id);
        return view ('posts.post-details',['post'=>$post,'user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    //function for showing the edit posts page
    {
        $post = Post::findOrFail($id);
        return view ('posts.edit-posts',['post'=>$post]);
        //
    }

    public function updatePost(Request $request)
    //function for updating the post
    {

        $request->validate([
            //validation for updating the post
            'title'=> 'required',
            'mainbody'=> 'required',
            'image'=> 'mimes:jpeg,jpg,png'
        ]);


        if($request->image !=null)
        {
            $image = $request->file('image');
            $image_name = time().'.'.$image->extension();
            $request->image->move(public_path('images'),$image_name);
        }
        else
        {
            $image_name = 'empty.jpg';
        }

        $post=Post::find($request->id);
        $post->title=$request->title;
        $post->mainbody=$request->mainbody;
        $post->image = $image_name;
        $post->save();
        return redirect('posts');
    }

    public function deletePost($id)
    {
        //function for deleting post
        $post=Post::find($id);
        $post->delete();
        return redirect('posts');
    }

    function save_comment(Request $request){
        //function for saving a comment
        $data=new Comment;
        $data->user_id = Auth::guard()->id();
        $data->post_id=$request->post;
        $data->mainbody=$request->comment;
        $data->save();
        return response()->json([
            'bool'=>true
        ]);
    }

    function edit_comment(Request $request){
        //fucntion for editing a comment
        $comment = Comment::where('id', $request->commentId)->first();
        $comment->mainbody=$request->comment;
        $comment->save();
        return response()->json([
            'bool'=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
