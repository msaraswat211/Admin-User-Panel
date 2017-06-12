<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // display all posts
        $posts=Post::paginate(10);
        $cate=Category::all();
        return view('admin.posts.index',compact('posts', 'cate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return to create new post page
        $cate=Category::lists('name', 'id')->all();
        return view('admin.posts.create', compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        // store post in db
        $input=$request->all();
        $user=auth::user();

        if($file=$request->file('photo_id')){

            $name=time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo=Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;

        }
        $user->posts()->create($input);
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //edit post
        $post=Post::findOrFail($id);
        $cate=Category::lists('name', 'id')->all();
        return view('admin.posts.edit', compact('post', 'cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update post
        $input=$request->all();

        if($file=$request->file('photo_id')){

            $name=time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo=Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;

        }

        Auth::user()->posts()->whereId($id)->first()->update($input);
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete post with images
        $post=Post::findOrFail($id);
        unlink(public_path(). $post->photo->file);
        $post->delete();
        return redirect('/admin/posts');
    }

    /*
     * function for post page data
     */
    public function post($id){
        $post=Post::findOrFail($id);
        $comments=$post->comments()->whereIsActive(1)->get();
        return view('post', compact('post', 'comments'));
    }
}
