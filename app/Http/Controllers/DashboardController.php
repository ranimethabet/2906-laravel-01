<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function statistics()
    {
        // users count
        $user = DB::table("users")->count();

        // posts count
        $post = DB::table("posts")->count();

        // comments count
        $comments = DB::table("comments")->count();

        // replies count
        $replies = DB::table("replies")->count();

        // reactions count
        $reactions = DB::table("reactions")->count();

        return [
            'users' => $user,
            'posts' => $post,
            'comments' => $comments,
            'replies' => $replies,
            'reactions' => $reactions,
        ];
    }
}
