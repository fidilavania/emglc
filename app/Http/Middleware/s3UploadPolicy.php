<?php

namespace App\Http\Middleware;
use Log;
use Closure;

class s3UploadPolicy
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

        $response = $next($request);
        Log::info("middleware terpanggil");
        $response->header('ACL', 'public-read');

        return $response;
    }
}
