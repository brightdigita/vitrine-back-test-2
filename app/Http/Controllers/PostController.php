<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Post::paginate(20));
    }

    public function owner()
    {
        return response()->json(auth()->user()->company->posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => ['required', 'min:5'],
            'content' => ['required'],
        ]);

        $post = auth()->user()->company->posts()->create([
            'title' => $request->title,
            'slug' => Post::slug(),
            'content' => $request->content,
            'poster' => $request->poster
        ]);

        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        return  response()->json(Post::whereSlug($post)->firstOrFail());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $request->validate([
            "title" => ['required', 'min:5'],
            'content' => ['required'],
        ]);

        $post = Post::whereSlug($post)->firstOrFail();

        $post->title = $request->title;
        $post->content = $request->content;
        $post->poster = $request->poster;

        $post->save();

        return response()->json($post->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        Post::whereSlug($post)->delete();

        return response()->json();
    }
}
