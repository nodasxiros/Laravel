<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
    	$posts = Post::paginate(10);
    	return view('blog.index', compact('posts'));
    	/*
    	$response = Rensponse::json($posts,200);
    	return $response;
    	*/
    }

    public function show($slug)
	{
	    $post = Post::whereSlug($slug)->firstOrFail();
	    $comments = $post->comments()->get();
	    return view('blog.show', compact('post', 'comments'));
	}

}
