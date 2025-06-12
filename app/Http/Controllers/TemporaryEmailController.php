<?php

namespace App\Http\Controllers;

use App\Services\RateLimiterService;
use App\Services\TemporaryEmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TemporaryEmailController extends Controller
{
    protected TemporaryEmailService $service;
    protected RateLimiterService $rateLimiter;


    public function __construct(TemporaryEmailService $service, RateLimiterService $rateLimiter)
    {
        $this->service = $service;
        $this->rateLimiter = $rateLimiter;
    }

    public function generate(Request $request): JsonResponse
    {

        if ($this->rateLimiter->tooManyRequests($request)) {
            return response()->json(['error' => 'Too many requests from your IP'], 429);
        }

        return $this->service->generate($request);
    }
    public function list()
    {
        return $this->service->get_all();
    }
}
