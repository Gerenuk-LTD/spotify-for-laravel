<?php

namespace Gerenuk\SpotifyForLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Gerenuk\SpotifyForLaravel\SpotifyClient
 */
class SpotifyClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Gerenuk\SpotifyForLaravel\SpotifyClient::class;
    }
}
