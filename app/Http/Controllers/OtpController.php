<?php

namespace App\Http\Controllers;

use App\Models\EmailAliasService;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\OtpService;
use Symfony\Component\HttpFoundation\JsonResponse;

class OtpController extends Controller
{
    protected OtpService $otp;

    public function __construct(OtpService $otp)
    {
        $this->otp = $otp;
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'purpose' => 'required|string',
        ]);

        $email = $validated['email'];
        $purpose = $validated['purpose'];

        $otpCode = $this->otp->generate($email, $purpose);

        return $otpCode;
    }
    public function send(Request $request) {}
    public function verify(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required',
            'email' => 'required|email',
            'purpose' => 'required|string',

        ]);

        $code = $validated['code'];
        $email = $validated['email'];
        $purpose = $validated['purpose'];

        $verify = $this->otp->verify($email, $code, $purpose);

        return $verify;
    }
}
