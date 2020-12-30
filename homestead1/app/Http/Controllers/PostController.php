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
        $posts = Post::all();
        return view('posts.index',['posts'=> $posts]);
        
    }

    public function viewCreate()
    {
        $tags = Tag::all();
        return view ('posts.create-posts',['tags'=>$tags]);
    }

    public function createPosts(Request $request)
    {
        $user = User::where('id', '=', Auth::guard()->id())->first();
        $posts = new Post;
        $posts->title=$request->title;
        $posts->mainbody=$request->mainbody;
        $posts->user_id=$user->id;
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
    {
    
        $post = Post::findOrFail($id);
        return view ('posts.edit-posts',['post'=>$post]);
        //
    }

    public function updatePost(Request $request)
    {
        $post=Post::find($request->id);
        $post->title=$request->title;
        $post->mainbody=$request->mainbody;
        $post->save();
        return redirect('posts');
    }

    public function deletePost($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect('posts');
    }

    function save_comment(Request $request){
        $data=new Comment;
        $data->user_id = Auth::guard()->id();
        $data->post_id=$request->post;
        $data->mainbody=$request->comment;
        $data->save();
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
