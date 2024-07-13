<?php

namespace Atom\Voting;

use Atom\Voting\Http\Middleware\VotingMiddleware;
use Atom\Voting\Services\FindRetrosService;
use Illuminate\Support\ServiceProvider;

class VotingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            path: __DIR__.'/../config/voting.php',
            key: 'voting'
        );

        $this->app->bind(
            abstract: FindRetrosService::class,
            concrete: fn () => new FindRetrosService
        );

        $this->app['router']
            ->aliasMiddleware(
                name: 'voting.check',
                class: VotingMiddleware::class,
            );
    }
}
