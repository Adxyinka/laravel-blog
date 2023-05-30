<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    // Signup Method
    public function signup(SignupRequest $request): JsonResponse 
    {
        $user = User::create($request->validated());

        $token = $user->createToken("$user->name token")->accessToken;

        return response()->json([
             'message' => 'user created successfully',
            'data' => $user,
            'token' => $token,
            'status' => 201,
            ]);
    }

    // Signin Method
    public function signin(SigninRequest $request ): jsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password or email incorrect']
            ]);
        }

        $token = $user->createToken("$user->name token")->accessToken;

        return response()->json([
             'message' => 'user signed in successfully',
            'data' => [
                'user' => $user,
                'token' => $token
            ],
             'status' => 200,
            ]);
    }
}
