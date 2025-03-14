<?php

namespace Gerenuk\Spotify;

use Gerenuk\Spotify\Commands\SpotifyCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SpotifyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('spotify-for-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_spotify_for_laravel_table')
            ->hasCommand(SpotifyCommand::class);
    }
}
