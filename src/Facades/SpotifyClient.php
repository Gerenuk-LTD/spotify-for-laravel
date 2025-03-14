<?php

namespace Gerenuk\SpotifyForLaravel\Facades;

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
