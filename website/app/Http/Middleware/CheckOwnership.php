<?php

namespace App\Http\Middleware;

use Closure;

class CheckOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $resourceName, $resourceId)
    {
        $id = $request->route($resourceId);
        $authorized = app($resourceName)::authorized($id, $request->user()->id)->count() > 0;

        if (!$authorized) {
            return response()->json(['error' => 'Unauthorized action'], 403);
        }

        return $next($request);
    }
}
