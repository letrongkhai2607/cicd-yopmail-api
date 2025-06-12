<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RateLimiterService
{
    public function tooManyRequests(Request $request): bool
    {
        $ip = $request->ip();
        $ipKey = "email_create_ip_{$ip}";

        if (Cache::has($ipKey)) {
            $count = Cache::increment($ipKey);

            if ($count > 5) {
                Log::channel('ip_limit')->warning('Too many requests from IP: ' . $ip);
                return true;
            }
        } else {
            Cache::put($ipKey, 1, now()->addHour());
        }

        return false;
    }

    public function getIpKey(Request $request): string
    {
        return "email_create_ip_" . $request->ip();
    }

    public function getUserAgentKey(Request $request): string
    {
        return "email_create_agent_" . md5($request->header('User-Agent'));
    }
}
