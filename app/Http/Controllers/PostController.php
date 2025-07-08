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
        $post->user_id = Auth::id();
        $post->name = Auth::user()->name; // Assuming the user is authenticated
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->back()->with('success', 'Post created successfully!');
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
     * Show the form for creating a new resource.
     */
    public function show()
    {
        $post = Post::with('user', 'comments.user')->findOrFail(request()->route('post')); // Assuming you have a route parameter named 'post'
        return view('posts.show', compact('post'));
    }

    /**
     * Store a comment for the specified post.
     */
    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully!');
    }

    /**
     * Like a post.
     */
    public function likePost(Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            // If the user has already liked the post, remove the like
            $like->delete();
            return redirect()->back();
        } else {
            // If the user has not liked the post, create a new like
            $post->likes()->create(['user_id' => Auth::id()]);
            return redirect()->back();
        }
    }

    /**
     * Unlike a post.
     */
    public function unlikePost(Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            // If the user has already liked the post, remove the like
            $like->delete();
            return redirect()->back()->with('success', 'Post unliked successfully!');
        } else {
            return redirect()->back()->with('error', 'You have not liked this post yet.');
        }
    }

    /**
     * Display a listing of trending posts.
     */
    // public function trending()
    // {
    //     $trendingPosts = Post::withCount('likes')
    //         ->orderByDesc('likes_count')
    //         ->take(5)
    //         ->get();

    //     return view('posts.trending', compact('trendingPosts'));
    // }

    public function trendingToday()
    {
        $today = now()->startOfDay();
        $now = now()->endOfDay();
        $trendingPosts = Post::with(['user'])
            ->withCount(['likes', 'comments'])
            ->whereBetween('created_at', [$today, $now])
            ->get()
            ->map(function ($post) {
                // Formula custom: like = 1pt, comment = 2pt
                $post->trending_score = ($post->likes_count * 1) + ($post->comments_count * 2);
                return $post;
            })
            ->sortByDesc('trending_score')
            ->take(5);

        return view('posts.trending', compact('trendingPosts'));
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
