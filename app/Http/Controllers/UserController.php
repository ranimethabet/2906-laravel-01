<?php

namespace App\Http\Controllers;

use App\Http\Resources\MiniUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = DB::table("users")
        //     ->join("posts", "posts.user_id", "=", "users.id")
        //     ->join("comments", "comments.post_id", "=", "posts.id")
        //     ->join("replies", "replies.comment_id", "=", "comments.id")
        //     ->get();

        // $users = User::with('posts.comments.replies')->get();
        $users = User::with('posts')->get();

        return UserResource::collection($users);
    }

    public function contacts()
    {
        $contacts = User::get();

        return MiniUserResource::collection($contacts);
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
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user->toResource();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
