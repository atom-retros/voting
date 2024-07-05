<?php

namespace Atom\Voting\Tests;

use Atom\Voting\VotingServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Set up the test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Atom\\Voting\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    /**
     * Define environment setup.
     */
    protected function getPackageProviders($app)
    {
        return [
            VotingServiceProvider::class,
        ];
    }
}
