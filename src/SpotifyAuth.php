<?php

namespace Gerenuk\SpotifyForLaravel;

use Gerenuk\SpotifyForLaravel\Exceptions\SpotifyAuthException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Gerenuk\SpotifyForLaravel\Facades\SpotifyClient;

class SpotifyAuth
{
    private const ACCOUNT_URL = 'https://accounts.spotify.com';

    private string $clientId;

    private string $clientSecret;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Initiate the 'Authorization Code Flow' prompting the user to log in to Spotify and give required permissions for your application.
     *
     * @link https://developer.spotify.com/documentation/web-api/tutorials/code-flow
     *
     * @return RedirectResponse
     */
    public function authorize(): RedirectResponse
    {
        $scope = config('spotify-for-laravel.auth.scope');

        $parameters = [
            'client_id' => $this->clientId,
            'redirect_uri' => config('spotify-for-laravel.auth.redirect_uri'),
            'response_type' => 'code',
            'scope' => isset($scope) ? implode(' ', $scope) : null,
            'show_dialog' => config('spotify-for-laravel.auth.show_dialog', false),
        ];

        $redirectUrl = self::ACCOUNT_URL . '/authorize?' . http_build_query($parameters);
        return redirect()->away($redirectUrl);
    }

    /**
     * If the user has accepted the initial authorize() request then exchange that authorization code for an access token.
     *
     * @link https://developer.spotify.com/documentation/web-api/tutorials/code-flow
     *
     * @param  string  $authorizationCode
     * @return array
     * @throws SpotifyAuthException
     */
    public function requestAccessToken(string $authorizationCode): array
    {
        $parameters = [
            'code' => $authorizationCode,
            'grant_type' => 'authorization_code',
            'redirect_uri' => config('spotify-for-laravel.auth.redirect_uri'),
        ];

        try {
            $response = SpotifyClient::post(self::ACCOUNT_URL.'/api/token', [
                'form_params' => $parameters,
                'headers' => [
                    'content-type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Basic '.base64_encode($this->clientId.':'.$this->clientSecret),
                ],
            ]);
        } catch (RequestException $e) {
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents());
            $status = $e->getCode();
            $message = $errorResponse->error;

            throw new SpotifyAuthException($message, $status, $errorResponse);
        }

        $body = json_decode((string) $response->getBody());

        Cache::remember('spotify_access_token', $body->expires_in, function () use ($body) {
            return $body->access_token;
        });
        Cache::put('spotify_refresh_token', $body->refresh_token);

        return ['access_token' => $body->access_token, 'expires_in' => $body->expires_in];
    }

    /**
     * Get an access token using the 'Client Credentials Flow'.
     *
     * @return void
     * @throws SpotifyAuthException
     */
    private function requestCredentialsToken(): void
    {
        try {
            $response = SpotifyClient::post(self::ACCOUNT_URL.'/api/token', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accepts' => 'application/json',
                    'Authorization' => 'Basic '.base64_encode($this->clientId.':'.$this->clientSecret),
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);
        } catch (RequestException $e) {
            $errorResponse = json_decode($e->getResponse()->getBody()->getContents());
            $status = $e->getCode();
            $message = $errorResponse->error;

            throw new SpotifyAuthException($message, $status, $errorResponse);
        }

        $body = json_decode((string) $response->getBody());

        Cache::remember('spotify_access_token', $body->expires_in, function () use ($body) {
            return $body->access_token;
        });
    }

    public function refreshAccessToken(?string $refreshToken = null) {}

    /**
     * Retrieve the currently stored access token from the cache.
     *
     * @return string
     */
    public function getAccessToken(): string
    {
        if (! Cache::has('spotify_access_token')) {
            $this->refreshAccessToken();
        }

        return Cache::get('spotify_access_token');
    }

    /**
     * Set an access token to be stored in the cache.
     *
     * @param  string  $accessToken
     * @param  int|null  $ttl
     * @return void
     */
    public function setAccessToken(string $accessToken, int $ttl = null): void
    {
        Cache::put('spotify_access_token', $accessToken, $ttl);
    }

    /**
     * Get the currently stored refresh token from the cache.
     *
     * @return string|null
     */
    public function getRefreshToken(): string|null
    {
        return Cache::get('spotify_refresh_token');
    }

    /**
     * Set a refresh token to be stored in the cache.
     *
     * @param  string  $refreshToken
     * @return void
     */
    public function setRefreshToken(string $refreshToken): void
    {
        Cache::put('spotify_refresh_token', $refreshToken);
    }
}
