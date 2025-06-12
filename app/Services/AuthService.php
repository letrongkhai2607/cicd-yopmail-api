<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{

    public function attemptLogin(array $credentials): ?string
    {
        return JWTAuth::attempt($credentials);
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function logout(): void
    {
        Auth::logout();
    }
    public function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ];
    }
}
