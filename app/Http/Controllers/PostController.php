<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::with('reactions')->limit($this->limit)->get();

        return new PostCollection($posts);
    }

    public function by_user($user_id)
    {

        // Same results
        // $posts = Post::where('user_id', '=', $user_id)->get();
        // $posts = DB::table('posts')->where('user_id', '=', $user_id)->get();
        // $posts = Post::where('user_id', $user_id)->get();
        $posts = DB::table('posts')->where('user_id', $user_id)->get();
        return PostResource::collection($posts);
    }

    public function ids_by_post_status($post_status_id)
    {

        // Get a single column
        $posts = DB::table('posts')
            ->where('post_status_id', '=', $post_status_id)
            ->pluck('id');

        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $data = $request->validated();

        // Temporary solution
        $data['user_id'] = 1;

        $added_post = Post::create($data);

        return $added_post;

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {


        $post->load(['comments.replies', 'reactions.reactionType']);

        $readyPost = $post->toResource();
        return new PostResource($readyPost);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // return $request->validated();
        $data = $request->validated();

        $updated = $post->update($data);

        if ($updated)
            return new PostResource($post);

        return 'Post faild to update';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // return Post::destroy($post->id);

        // OR

        return $post->delete();
    }

    public function deleted()
    {
        // Get only soft deleted records
        $posts = Post::onlyTrashed()->get();

        return PostResource::collection($posts);
    }

    public function restore_post($id)
    {
        $post = Post::onlyTrashed()->find($id);

        // OR
        // $post = Post::withTrashed()->find($id);
        // OR

        // $post = Post::withTrashed()->where('id', $id)->first();

        if ($post === null)
            return 'Not found';

        if ($post->restore())
            return 'Post Restored Successfully';

        return 'Post failed to restore';
    }
}