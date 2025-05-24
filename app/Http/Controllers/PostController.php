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

        $posts = Post::with('reactions')->get();

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
        return view('create-post');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        // Same as using the StorePostRequest class

        // $data = $request->validate(
        //     [
        //         'title' => 'required|min:10|max:255',
        //         'body' => ['required', 'min:50', 'max:255'],
        //         'post_status_id' => 'required|integer|exists:post_statuses,id',
        //     ],
        //     [
        //         'title.required' => 'أسم المقال مطلوب',
        //         'title.min' => 'يجب ان يكون عنوان المقال اكثر من 10 حروف',
        //         'title.max' => 'يجب ان يكون عنوان المقال اقل من 255 حروف',
        //         'body.required' => 'لابد من كتابة محتوى للمقال',
        //         'body.min' => 'يجب ان يكون محتوى المقال اكثر من 50 حروف',
        //         'body.max' => 'يجب ان يكون محتوى المقال اقل من 255 حروف',
        //         'post_status_id.required' => 'لابد من اختيار حالة المقال',
        //         'post_status_id.integer' => 'يجب ان يكون حالة المقال رقم',
        //         'post_status_id.exists' => 'حالة المقال غير مقبولة',
        //     ]
        // );

        $data = $request->validated();

        return $data;

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
