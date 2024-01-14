<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public $image;
    
    // Show all posts
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create() {
        // Define $image variable to avoid undefined variable error
        $image = null;
    
        return view('posts.create', compact('image'));
    }

    // Store new post in database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Handle file upload
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create a new post instance
        $post = new Post([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath, // Save the image path to the database
        ]);

        // Save the post
        $post->save();

        // Redirect back with success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }


    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post, 'currentImage' => asset('storage/' . $post->image)]);
    }



    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation
        ]);

        // Handle file upload
        $imagePath = $post->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Update post data
        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        // Redirect back with success message
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post', [
            'except' => ['index'], // Exclude 'index' from authorization
        ]);
    }

}
