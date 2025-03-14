<?php

namespace Gerenuk\SpotifyForLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gerenuk\SpotifyForLaravel\Spotify
 */
class Spotify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Gerenuk\SpotifyForLaravel\Spotify::class;
    }
}
