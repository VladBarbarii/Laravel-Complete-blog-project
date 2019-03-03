<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(3);
        $tags = Tag::all();
        $categories= Category::all();
        return view('pages.index', compact('posts', 'tags', 'categories'));

       //we can also make an associative array of $data and return view ('routeName', $data)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.addPost');
    }

    public function byCategory(Category $category)
    {
        $posts=Post::where('category_id', $category->id);
        return view('pages.index', compact('posts'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'content'=>'required',
            'category'=>'required',
            'tags'=>'required|array',
            'image' => 'required|file|mimes:png,jpeg,gif|max:1000',
            'imageTitle'=>'required',

        ]);

//        $path = $request->file('image')->storePublicly('public'); //
        $filenameToStore = $this->storeImage($request);

        $post = new Post();
        $post->name=$request->input('name');
        $post->user_id=Auth::user()->id;
        $post->content=$request->input('content');
        $post->category_id=$request->input('category');
        $post->imageTitle=$request->input('imageTitle');
        $post->image = $filenameToStore;

        $post->save();

        $post->tags()->attach($request->tags);
        return redirect('posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->increment('timesViewed');
        $post->save();
        return view('pages.singlePost', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
//        if (auth()->id()==$post->user_id)
//            return view('pages.editPost', compact('post'));
//        abort(403);

        $this->authorize('update', $post);
        return view('pages.editPost', compact('post'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'name'=>'required',
            'content'=>'required',
            'category'=>'required',
            'tags'=>'required|array',
            'image' => 'required|file|mimes:png,jpeg,gif|max:1999',
            'imageTitle'=>'required',

        ]);

        //delete old image then update the value of the image in the post and save it to db

        if ($request->hasFile('image')){
            $oldImage = $post->image;
            Storage::delete('public/post_images/',$oldImage);
            $filenameToStore = $this->storeImage($request);
        }


        $post->update( [
            'name'=>$request->input('name'),
            'content'=>$request->input('content'),
            'category_id'=>$request->input('category'),
            'user_id'=>Auth::user()->id,
            'image' => $request->hasFile('image') ? $filenameToStore : $post->image,
            'imageTitle'=>$request->input('imageTitle'),]);

        $postToBeChanged = Post::findOrFail($post->id);
        $postToBeChanged->tags()->detach();

        $post->tags()->attach($request->tags);

        return redirect('/');
    }

    public function myPosts(){
        //only the posts that bbelong to the current user

        $posts = \Auth::user()->posts()->paginate(3);
        $tags = Tag::all();
        $categories= Category::all();
        return view('pages.index', compact('posts', 'tags', 'categories'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/');
    }

       /**
     * @param Request $request
     * @return string
     */
    public function storeImage(Request $request): string
    {
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameToStore = $fileName . '_' . time() . '.' . $extension;
        $path = $request->file('image')->storeAs('public/post_images', $filenameToStore);
        return $filenameToStore;
    }
}
