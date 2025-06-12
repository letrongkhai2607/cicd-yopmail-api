<?php

namespace App\Services;

use App\Models\Otp;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OtpService
{
    public function generate(string $email, string $purpose = 'verify-alias'): string
    {
        $otp = rand(100000, 999999);

        Otp::create([
            'email' => $email,
            'code' => $otp,
            'purpose' => $purpose,
            'expires_at' => now()->addMinutes(10),
        ]);

        return (string) $otp;
    }

    public function send(string $email, string $purpose = 'verify-alias'): void
    {
        $otp = $this->generate($email, $purpose);

        //Mail::to($email)->send(new \App\Mail\GenericOtpMail($otp));
    }

    public function verify(string $email, string $code, string $purpose = 'verify-alias'): bool
    {
        $otp = Otp::where('email', $email)
            ->where('code', $code)
            ->where('purpose', $purpose)
            ->where('expires_at', '>', now())
            ->where('used', false)
            ->latest()
            ->first();

        if (! $otp) {
            return false;
        }

        $otp->update(['used' => true]);

        return true;
    }
}
