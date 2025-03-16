<?php

namespace Gerenuk\SpotifyForLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void authorize()
 * @method static array requestAccessToken(string $authorizationCode)
 * @method static array requestCredentialsToken()
 * @method static array refreshAccessToken(?string $refreshToken = null)
 * @method static string getAccessToken()
 * @method static void setAccessToken(string $accessToken, ?int $ttl = null)
 * @method static string getRefreshToken()
 * @method static void setRefreshToken(string $refreshToken)
 *
 * @see \Gerenuk\SpotifyForLaravel\SpotifyAuth
 */
class SpotifyAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Gerenuk\SpotifyForLaravel\SpotifyAuth::class;
    }
}
