<?php

namespace Atom\Voting\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FindRetrosService
{
    /**
     * The service instance.
     */
    protected PendingRequest $service;

    /**
     * Construct the Find Retros service.
     */
    public function __construct()
    {
        $this->service = Http::baseUrl(config('voting.url', 'https://findretros.com'))
            ->withOptions(['verify' => false]);
    }

    /**
     * Verify the user's vote.
     */
    public function voted(): bool
    {
        $request = app('request');

        $cacheKey = sprintf(config('voting.cache_key'), $request->ip());

        if (! config('voting.enabled', false)) {
            return false;
        }

        if ($request->ip() === '127.0.0.1') {
            return true;
        }

        if ($request->has('novote')) {
            return true;
        }

        if ($request->has($cacheKey)) {
            return true;
        }

        if (Cache::has($cacheKey)) {
            return true;
        }

        $response = $this->service
            ->get(sprintf(config('voting.verify_url'), config('voting.username'), $request->ip()));

        if (in_array($response->json(), ['1', '2'])) {
            Cache::put($cacheKey, true, now()->addMinutes(30));

            return true;
        }

        return false;
    }

    /**
     * Get the redirect URI.
     */
    public function getRedirectUri(): string
    {
        return sprintf(config('voting.redirect_url'), config('voting.url'), config('voting.username'), http_build_query([
            'minimal' => config('voting.minimal'),
            'return' => config('voting.return'),
        ]));
    }
}
