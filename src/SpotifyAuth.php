<?php

namespace Gerenuk\SpotifyForLaravel;

use Gerenuk\SpotifyForLaravel\Exceptions\SpotifyAuthException;
use Gerenuk\SpotifyForLaravel\Facades\SpotifyClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

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
     */
    public function authorize(): void
    {
        $scope = config('spotify-for-laravel.auth.scope');

        $parameters = [
            'client_id' => $this->clientId,
            'redirect_uri' => config('spotify-for-laravel.auth.redirect_uri'),
            'response_type' => 'code',
            'scope' => isset($scope) ? implode(' ', $scope) : null,
            'show_dialog' => config('spotify-for-laravel.auth.show_dialog', false),
        ];

        $redirectUrl = self::ACCOUNT_URL.'/authorize?'.http_build_query($parameters);
        header('Location: '.$redirectUrl);
        exit();
    }

    /**
     * If the user has accepted the initial authorize() request then exchange that authorization code for an access token.
     *
     * @link https://developer.spotify.com/documentation/web-api/tutorials/code-flow
     *
     * @throws SpotifyAuthException
     */
    public function requestAccessToken(string $authorizationCode): array
    {
        $parameters = [
            'code' => $authorizationCode,
            'grant_type' => 'authorization_code',
            'redirect_uri' => config('spotify-for-laravel.auth.redirect_uri'),
        ];

        return $this->handleAuthRequest($parameters);
    }

    /**
     * Get an access token using the 'Client Credentials Flow'.
     *
     * @link https://developer.spotify.com/documentation/web-api/tutorials/client-credentials-flow
     *
     * @throws SpotifyAuthException
     */
    public function requestCredentialsToken(): array
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

        Session::put('spotify_access_token', $body->access_token);

        return ['access_token' => $body->access_token, 'token_type' => $body->token_type, 'expires_in' => $body->expires_in];
    }

    /**
     * @throws SpotifyAuthException
     */
    private function handleAuthRequest(array $parameters): array
    {
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

        Session::put('spotify_access_token', $body->access_token);

        // When refreshing an access token, a refresh token won't be returned.
        if (isset($body->refresh_token)) {
            Session::put('spotify_refresh_token', $body->refresh_token);
        }

        return ['access_token' => $body->access_token, 'refresh_token' => isset($body->refresh_token) ?? null, 'expires_in' => $body->expires_in];
    }

    /**
     * Retrieve the currently stored access token from the cache.
     *
     * @throws SpotifyAuthException
     */
    public function getAccessToken(): string
    {
        if (! Session::has('spotify_access_token')) {
            $this->refreshAccessToken();
        }

        return Session::get('spotify_access_token');
    }

    /**
     * Obtain a new Access Token by using a Refresh Token.
     *
     * @link https://developer.spotify.com/documentation/web-api/tutorials/refreshing-tokens
     *
     * @throws SpotifyAuthException
     */
    public function refreshAccessToken(?string $refreshToken = null): array
    {
        $parameters = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken ?? Session::get('spotify_refresh_token'),
        ];

        return $this->handleAuthRequest($parameters);
    }

    /**
     * Set an access token to be stored in the cache.
     */
    public function setAccessToken(string $accessToken): void
    {
        Session::put('spotify_access_token', $accessToken);
    }

    /**
     * Get the currently stored refresh token from the cache.
     */
    public function getRefreshToken(): ?string
    {
        return Session::get('spotify_refresh_token');
    }

    /**
     * Set a refresh token to be stored in the cache.
     */
    public function setRefreshToken(string $refreshToken): void
    {
        Session::put('spotify_refresh_token', $refreshToken);
    }
}
