<?php

namespace Gerenuk\Spotify\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gerenuk\Spotify\Spotify
 */
class Spotify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Gerenuk\SpotifyForLaravel\Spotify::class;
    }
}
