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
        // replies count
        // reactions count

        return [
            'users' => $user,
            'posts' => $post
        ];
    }
}
