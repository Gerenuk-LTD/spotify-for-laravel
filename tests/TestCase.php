<?php

namespace Gerenuk\SpotifyForLaravel\Tests;

use Gerenuk\SpotifyForLaravel\SpotifyForLaravelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            SpotifyForLaravelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void {}
}
