<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // -------------- Query Builder VS. Eloquent ORM ------------

        // Same results
        // $posts = Post::all(); // eloquent (ORM)
        // $posts = Post::get(); // eloquent (ORM)
        // $posts = DB::table('posts')->get();

        // Same results with joins
        // SELECT `posts`.`id` AS `post_id`, `title`, `body`, `type`, `user_id`, `post_statuses`.`id` `post_status_id`  FROM `posts` JOIN `post_statuses` ON `post_statuses`.`id` = `posts`.`post_status_id` ORDER BY `posts.id`
        // $posts = DB::table('posts')
        // ->join('post_statuses', 'post_statuses.id', '=', 'posts.post_status_id')
        // ->select(['posts.id AS post_id', 'title AS Post Title', 'body', 'type', 'user_id', 'post_statuses.id AS post_status_id'])
        // ->orderBy('posts.id')
        // ->get();


        // $posts = Post::with('post_status')->get();
        // $posts = Post::with(['post_status', 'user', 'comments'])->get();


        // $posts = Post::with(['reactions'])->get(); // Get everything from all tables
        // $posts = Post::with(['reactions'])->get(['id', 'title', 'body']); // Get everything from sub tables and only selected from parent table
        // $posts = Post::with(
        //     [
        //         'reactions' => function ($query) {
        //             $query->select(['reactionable_id', 'reaction_type_id', 'user_id']);
        //         }
        //     ]
        // )->get(['id', 'title', 'body']); // get selected from all tables


        // $posts = Post::with(
        //     [
        //         'reactions' => function ($query) {
        //             $query->select(['reactionable_id', 'reaction_type_id', 'user_id']);
        //         },
        //         'comments' => function ($qry) {
        //             $qry->select(['post_id', 'comment']);
        //         }
        //     ]
        // )->get(['id', 'title', 'body']); // get selected from all tables


        // $posts = Post::
        //     with(['reactions:reactionable_id,user_id,reaction_type_id', 'comments:post_id,comment'])
        //     ->get(['id', 'title', 'body']); // get selected from all tables

        // $posts = Post::with('comments')->get();
        // $posts = Post::get();

        $posts = Post::paginate(100);

        // Get a single value as a string/number
        // $posts = DB::table('posts')
        //     ->where('id', '=', 5)
        //     ->value('title');


        // $readyPosts = PostResource::collection($posts);
        // $readyPosts = $posts->toResourceCollection();
        // PostCollection::wrap('Content');
        $readyPosts = new PostCollection($posts);

        return $readyPosts;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        // $post->load(['post_status', 'user', 'comments:post_id,comment', 'reactions:reactionable_id,user_id,reaction_type_id']);

        // $post = DB::table('posts')
        // return $post;
        //     ->join('post_statuses', 'post_statuses.id', '=', 'posts.post_status_id')
        //     ->select(['posts.id AS post_id', 'title AS Post Title', 'body', 'type', 'user_id', 'post_statuses.id AS post_status_id'])
        //     ->where('posts.id', $post->id)
        //     ->get();

        // $post = Post::with('post_status')->where('id', $post)->first();



        // $post->load('post_status');
        // $post->load('post_status')->load('user');

        // The Same 
        // $post->load('comments');
        $post->load('comments.replies');

        // $readyPost = PostResource::make($post);
        // $readyPost = new PostResource($post);
        // PostResource::wrap('Content');
        // PostResource::withoutWrapping();
        $readyPost = $post->toResource();
        return $readyPost;

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
