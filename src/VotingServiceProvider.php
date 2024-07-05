<?php

namespace Atom\Voting;

use Atom\Voting\Services\FindRetrosService;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class VotingServiceProvider extends PackageServiceProvider
{
    /**
     * Register services.
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('voting')
            ->hasConfigFile();
    }

    /**
     * Bootstrap services.
     */
    public function register(): void
    {
        parent::register();

        $this->app->bind(
            FindRetrosService::class,
            fn () => new FindRetrosService
        );
    }
}
