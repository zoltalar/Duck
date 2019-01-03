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
        $this->middleware('auth:api');
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
}