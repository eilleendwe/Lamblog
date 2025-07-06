<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function store(Request $request)
    {
        // Logic to store a new post
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->name = Auth::user()->name; // Assuming the user is authenticated
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('dashboard')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function myPosts()
    {
        $posts = Post::where('name', Auth::user()->name)->get();
        return view('my-posts', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Logic to show the post edit form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Logic to update a specific post
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Logic to delete a specific post
    }
}
