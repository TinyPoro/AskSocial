<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Exception;

class UserServiceJwtMiddleware extends BaseMiddleware
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
        try {
            $xToken = $request->header('X-Token');

            $payload = JWTAuth::getJWTProvider()->decode($xToken);

            $request['channel_id'] = Arr::get($payload, 'channel_id', null);
        } catch (Exception $e) {
            throw $e;
        }

        return $next($request);
    }
}
