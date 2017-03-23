<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostFormRequest;
use App\Http\Requests\PostEditFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use App\Post;
use Response;

class PostsController extends Controller
{
    


    public function index()
    {
        $posts = Post::all();
        return view('backend.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }

    public function store(PostFormRequest $request)
    {
        $user_id = Auth::user()->id;
        $post = new Post(array(
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'slug' => Str::slug($request->get('title'), '-'),
            'user_id' => $user_id
            ));

        $post->save();
        $post->categories()->sync($request->get('categories'));

        return redirect('/admin/posts/create')->with('status', 'The post has been created!');
    }

    public function edit($id)
    {
        $post = Post::whereId($id)->firstOrFail();
        $categories = Category::all();
        $selectedCategories = $post->categories->pluck('id')->toArray();
        return view('backend.posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    public function show()
    {

    }

    public function update($id, PostEditFormRequest $request)
    {
        $post = Post::whereId($id)->firstOrFail();
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->slug = Str::slug($request->get('title'), '-');

        $post->save();
        $post->categories()->sync($request->get('categories'));

        return redirect(action('Admin\PostsController@edit', $post->id))->with('status', 'The post has been updated!');
    }

    public function destroy()
    {

    }


    /*
    ==== API Methods for Future Reference ===
    --- Routes for these methods must be defined
    --- In the API routes File
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*--public function index()
    {
        $posts = Post::paginate(10);
        $response = Response::json($posts,200);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*--public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*--public function store(Request $request)
    {
        if((!$request->title) || (!$request->content)){

            $response = Response::json([
                'error' => [
                    'message' => 'Please enter all required fields'
                ]
            ], 422);
            return $response;
        }

        $post = new Post(array(
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title, '-'),
            'user_id' => $request->user_id
        ));

        $post->save();

        $response = Response::json([
            'message' => 'The post has been created succesfully',
            'data' => $post,
        ], 201);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*--public function show($id)
    {
        $post= Post::find($id);

            if(!$post){
                $response = Response::json([
                    'error' => [
                        'message' => 'This post cannot be found.'
                    ]
                ], 404);
                return $response;
            }

            $response = Response::json($post
                , 200);
            return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*--public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*--public function update(Request $request, $id)
    {
        if((!$request->title) || (!$request->content)){

            $response = Response::json([
                'error' => [
                    'message' => 'Please enter all required fields'
                ]
            ], 422);
            return $response;
        }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = Str::slug($request->title, '-');
        $post->user_id = $request->user_id;
        $post->save();

        $response = Response::json([
            'message' => 'The post has been updated.',
            'data' => $post,
        ], 200);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*--public function destroy($id)
    {
        $post = Post::find($id);

        if(!$post) {
            $response = Response::json([
                'error' => [
                    'message' => 'The post cannot be found.'
                ]
            ], 404);

            return $response;
        }

        Post::destroy($id);

        $response = Response::json([
            'message' => 'The post has been deleted.'
        ], 200);

        return $response;
        }
        --*/
}
