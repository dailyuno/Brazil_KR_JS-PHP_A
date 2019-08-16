<?php

namespace App\Http\Middleware;

use App\Member;
use Closure;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->token;
        $member = Member::whereNotNull('token')->where('token', $token)->first();

        if ($member) {
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthorized user'
        ], 401);
    }
}
