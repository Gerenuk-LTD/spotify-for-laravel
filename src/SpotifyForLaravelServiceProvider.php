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

    public function packageRegistered(): void
    {
        $this->app->singleton(Spotify::class, function () {
            $defaultConfig = [
                'country' => config('spotify-for-laravel.default_config.country'),
                'locale' => config('spotify-for-laravel.default_config.locale'),
                'market' => config('spotify-for-laravel.default_config.market'),
            ];

            return new Spotify($defaultConfig);
        });

        $this->app->singleton(SpotifyAuth::class, function () {
            $clientId = config('spotify-for-laravel.auth.client_id');
            $clientSecret = config('spotify-for-laravel.auth.client_secret');

            return new SpotifyAuth($clientId, $clientSecret);
        });

        $this->app->bind(SpotifyClient::class, function () {
            return new SpotifyClient;
        });
    }
}
