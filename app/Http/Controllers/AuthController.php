<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\ChangePasswordRequest;
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

            if (!$user->hasVerifiedEmail())
                return response()->json(['message' => 'Email not verified'], 401);


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
            return redirect('http://127.0.0.1:5500/verification-expired.html');
        }

        $user = User::find($request->id);

        if (!$user) {
            return redirect('https://mwjb.net/register');
        }

        if ($user->email_verified_at) {
            return redirect('https://mwjb.net/login');
        }

        $user->markEmailAsVerified();

        return redirect('http://127.0.0.1:5500/login.html');

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

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()->delete())
            return response()->json(['message' => 'Logged out successfully'], 200);

        return response()->json(['message' => 'Cannot logout at the moment, please reload the page and try again'], 400);
    }

    public function logout_all(Request $request)
    {
        if ($request->user()->tokens()->delete())
            return response()->json(['message' => 'Logged out successfully'], 200);

        return response()->json(['message' => 'Cannot logout at the moment, please reload the page and try again'], 400);
    }

    public function logout_others(AuthLoginRequest $request)
    {

        $credits = $request->validated();


        // Be sure that the user is correctly authenticated
        // Validate email
        $user = User::where('email', $credits['email'])->first();

        if (!$user)
            return response()->json(['message' => 'Invalid email or password'], 404); // mail not found

        // Validate password
        if (!password_verify($credits['password'], $user->password))
            return response()->json(['message' => 'Invalid email or password'], 401); // Password is not correct

        $tokens = $request->user()->tokens()->get();

        $tokens_count = $tokens->count();

        $deleted_tokens = 0;

        if ($tokens_count == 1)
            return response()->json(['message' => 'You have only one session active'], 400);

        $currentTokenId = $request->user()->currentAccessToken()->id;


        foreach ($tokens as $token) {
            if ($token->id !== $currentTokenId) {
                if ($token->delete())
                    $deleted_tokens++;
            }
        }

        if ($deleted_tokens == $tokens_count - 1)
            return response()->json(['message' => 'Logged out successfully'], 200);

        return response()->json(['message' => 'Cannot logout from all devices at the moment, please reload the page and try again'], 400);
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $data = $request->validated();

        // Check the current password
        if (!password_verify($data['password'], auth()->user()->password))
            return response()->json(['message' => 'Current password is not correct'], 401);

        // Check if the new password is the same as the current password
        $user = auth()->user();
        $user['password'] = $data['new_password'];
        if ($user->save())
            return response()->json(['message' => 'Password changed successfully'], 200);

        return response()->json(['message' => 'Cannot change password at the moment, please reload the page and try again'], 400);


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
