<?php

namespace Gerenuk\SpotifyForLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SpotifyForLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('spotify-for-laravel')
            ->hasConfigFile();
    }
}
