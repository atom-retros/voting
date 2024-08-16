<?php

namespace Atom\Voting\Http\Middleware;

use Atom\Voting\Services\FindRetrosService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VotingMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $service = app(FindRetrosService::class);

        if (! config('voting.enabled', false)) {
            return $next($request);
        }

        if (! $service->voted($request, $next)) {
            return redirect()->to($service->getRedirectUri());
        }

        return $next($request);
    }
}
