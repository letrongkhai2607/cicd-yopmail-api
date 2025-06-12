<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AliasService
{
    public function sendOtp(string $aliasEmail, TemporaryEmail $tempEmail): void
    {
        $otp = rand(100000, 999999);
    
        $alias = EmailAlias::updateOrCreate(
            ['temporary_email_id' => $tempEmail->id, 'real_email' => $aliasEmail],
            ['otp' => $otp, 'otp_expires_at' => now()->addMinutes(10), 'is_verified' => false]
        );
    
        Mail::to($aliasEmail)->send(new VerifyAliasOtpMail($otp));
    }
}
