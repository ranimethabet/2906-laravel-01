<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Mail\ReverifyEmail;
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

            $verficationURL = $this->createSignedVerificationRoute($user->id);


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

        if (!$request->hasValidSignature()) {
            return redirect('https://mwjb.net');
        }

        $user = User::find($request->id);

        if (!$user) {
            return redirect('https://mwjb.net/register');
        }

        if ($user->email_verified_at) {
            return redirect('https://mwjb.net/login');
        }

        $user->markEmailAsVerified();

        return redirect('https://mwjb.net/login');

    }

    public function reverify(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        $verficationURL = $this->createSignedVerificationRoute($user->id);


        // Send a new email to the user
        Mail::to($user->email)->send(new ReverifyEmail($user, $verficationURL));

        return response()->json(['message' => 'Reverify email sent successfully'], 200);

    }

    public function active_sessions(Request $request)
    {
        return $request->user()->tokens()->get();
    }

    private function createSignedVerificationRoute($id)
    {

        // Create a signed route
        $url = url()->temporarySignedRoute(
            'auth.verify_email',
            now()->addMinutes(60),
            // now()->addSeconds(5),
            ['id' => $id]
        );

        return $url;
    }


}