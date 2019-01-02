<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Post;

class PostController extends Controller
{
    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->fill($request->only($post->getFillable()));

        if ($post->save()) {
            return response()->json($post->toArray());
        }
    }
}
