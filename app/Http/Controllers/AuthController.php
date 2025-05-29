<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $data = $request->only("email", "password");

        $auth = auth()->attempt($data);

        if ($auth) {
            return 'OK';
            $user = auth()->user();

            $token = $user->createToken('login')->plainTextToken;

            return [
                'user' => new UserResource($user),
                'token' => $token
            ];
        }

        return 'Email and password are not correct';
    }

    public function mobile_login(AuthLoginRequest $request)
    {
        $data = $request->only("email", "password");

        $auth = auth()->attempt($data);

        if ($auth) {
            $user = auth()->user();

            $token = $user->createToken('mobile_login')->plainTextToken;

            return [
                'user' => new UserResource($user),
                'token' => $token
            ];
        }

        return 'Email and password are not correct';
    }
}
