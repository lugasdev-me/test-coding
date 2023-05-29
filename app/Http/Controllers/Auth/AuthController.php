<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Laravel\Passport\Client;

class AuthController extends Controller
{
    // login with passport

    // guzzle error in docker (laradock) -- no-finish
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([
            'user' => auth()->user(),w
            'token' => $token
        ]);
    }

    // register with passport

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password'],
            'phone' => ['required', 'unique:users,phone'],
        ]);

        $credentials['password'] = bcrypt($credentials['password']);

        $user = User::create($credentials);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
