<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LogExcessiveRequests
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $key = "req_count_{$ip}";
        $limit = 10;   // max requests
        $minutes = 1;  // time window

        $count = Cache::get($key, 0) + 1;
        Cache::put($key, $count, now()->addMinutes($minutes));

        if ($count > $limit) {
            Log::warning("High traffic detected: {$ip} made {$count} requests in {$minutes} minute(s).");
        }

        return $next($request);
    }
}
