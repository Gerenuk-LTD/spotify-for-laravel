<?php

namespace Gerenuk\SpotifyForLaravel\Facades;

/**
 * @see \Gerenuk\SpotifyForLaravel\SpotifyAuth
 */
class SpotifyAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Gerenuk\SpotifyForLaravel\SpotifyAuth::class;
    }
}
