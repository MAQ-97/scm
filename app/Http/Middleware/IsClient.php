<?php

namespace App\Http\Middleware;

use App\Client;
use Closure;

class IsClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authorization = $request->header('authorization');
        $exists = Client::where('api_token', $authorization)->exists();

        if (!empty($authorization) && $exists) {
            return $next($request);
        }

        return response()->json([
            'status' => false,
            'message' => 'Authorization failed'
        ]);
    }
}
