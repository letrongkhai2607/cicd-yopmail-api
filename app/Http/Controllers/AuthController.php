<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = $this->auth->attemptLogin($credentials);

        if (!$token) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json($this->auth->respondWithToken($token));
    }

    public function me()
    {
        return response()->json($this->auth->getAuthenticatedUser());
    }

    public function logout()
    {
        $this->auth->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
