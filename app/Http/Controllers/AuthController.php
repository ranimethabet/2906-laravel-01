<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $data = $request->only("email", "password");

        $auth = auth()->attempt($data);

        if ($auth) {

            $user = auth()->user();

            $token = $user->createToken('login')->plainTextToken;

            return [
                'user' => new UserResource($user),
                'token' => $token
            ];
        }

        return 'Email and password are not correct';
    }

    public function register(AuthRegisterRequest $request)
    {


        $data = $request->validated();

        $data['roles'] = 'user';

        $user = User::create($data);

        // $token = $user->createToken('web_regiter')->plainTextToken;

        // Send a verification email to the user
        if ($user) {
            // Mail::to($user->email)->send(new VerificationEmail());


            // Create a signed route
            $verficationURL = url()->temporarySignedRoute(
                'auth.verify_email',
                now()->addMinutes(60),
                ['id' => 500]
            );


            // Next line is for testing
            Mail::to('magedyaseengroups@gmail.com')->send(new VerificationEmail($user, $verficationURL));

            return new UserResource($user);
        }

        return response()->json(['message' => 'Registration failed'], 500);

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

    public function verify_email(Request $request)
    {

        return $request->hasValidSignature() ? 'Valid' : 'Not valid';
    }
}