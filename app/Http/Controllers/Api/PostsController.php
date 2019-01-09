<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost as StorePostRequest;
use App\Http\Resources\Post as PostResource;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index()
    {
        return PostResource::collection(Post::paginate());
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->fill($request->only($post->getFillable()));
        $post->user_id = $request->user()->id;

        if ($post->save()) {
            return new PostResource($post);
        }
    }

    public function approve($id)
    {
        $post = Post::find($id);

        if ($post !== null) {
            $post->active = 1;
            $post->save();

            return new PostResource($post);
        }
    }

    public function disapprove($id)
    {
        $post = Post::find($id);

        if ($post !== null) {
            $post->active = 0;
            $post->save();

            return new PostResource($post);
        }
    }

    public function destroy($id)
    {
        return response()->json(['count' => Post::destroy($id)]);
    }
}