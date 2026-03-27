<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);
        $incomingFields['user_id'] = auth()->guard()->id();

        Post::create($incomingFields);
        return redirect('/');
    }

    public function showEditScreen(Post $post) {
        if (!auth()->guard()->check()) {
            return redirect('/');
        }

        return view('edit-post', ['post' => $post]);
    }

    public function updatePost(Request $request, Post $post) {
        if (!auth()->guard()->check()) {
            return redirect('/');
        }

        $incomingFields = $request->validate([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['content'] = strip_tags($incomingFields['content']);

        $post->update($incomingFields);
        return redirect('/');
    }

    public function deletePost(Request $request, Post $post) {
        if (!auth()->guard()->check()) {
            return redirect('/');
        }

        $post->delete();
        return redirect('/');
    }
}
