<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\SearchPostService;

class PostController extends Controller
{

    public function index(SearchRequest $request)
    {
        return PostResource::collection(SearchPostService::search($request->validated()));
    }


    public function store(CreatePostRequest $request)
    {
        return Post::create($request->validated());
    }


    public function show(Post $post)
    {
        return $post;
    }


    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
