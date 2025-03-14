<?php

namespace Gerenuk\Spotify;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SpotifyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('spotify-for-laravel')
            ->hasConfigFile();
    }
}
