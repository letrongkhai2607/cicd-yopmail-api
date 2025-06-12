<?php

namespace App\Http\Controllers;

use App\Models\EmailAlias;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Services\OtpService;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmailAliasController extends Controller
{
    protected OtpService $otp;

    public function __construct(OtpService $otp)
    {

        $this->otp = $otp;
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'temporary_email_id' => 'required|string',
        ]);


        $temporary_email_id = $validated['temporary_email_id'];
        $email = $validated['email'];

        $this->otp->generate($email);

        // Create email alias
        $alias = EmailAlias::create([
            'temporary_email_id' => $temporary_email_id,
            'real_email' => $email
        ]);
        return $alias;
    }
}
