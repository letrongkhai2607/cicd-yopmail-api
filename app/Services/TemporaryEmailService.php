<?php

namespace App\Services;

use App\Models\TemporaryEmail;
use Symfony\Component\HttpFoundation\JsonResponse;

class TemporaryEmailService
{
    public function generate(): JsonResponse
    {

        try {
            do {
                $username = 'user' . rand(1000, 9999);
                $email = $username . '@yopmail.com';
            } while (TemporaryEmail::where('email', $email)->exists());

            $response = TemporaryEmail::create([
                'username' => $username,
                'email' => $email,
                'expires_at' => now()->addHours(24),
            ]);
            return success_response($response);
        } catch (\Exception $e) {
            return failed_response($e);
        }
    }

    public function get_all(): JsonResponse
    {
        try {
            $emails = TemporaryEmail::all();
            return success_response($emails, 'Fetched all temporary emails');
        } catch (\Exception $e) {
            return failed_response($e);
        }
    }
}
