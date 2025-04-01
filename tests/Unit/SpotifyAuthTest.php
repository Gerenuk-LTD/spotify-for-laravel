<?php

use Gerenuk\SpotifyForLaravel\SpotifyAuth;
use Illuminate\Support\Facades\Session;

beforeEach(function () {
    $this->auth = Mockery::mock(SpotifyAuth::class, [
        'client_id' => 'client_id',
        'client_secret' => 'client_secret',
    ])->makePartial();
});

afterEach(function () {
    Mockery::close();
});

it('can get an access token using the oauth flow', function () {
    $this->auth->allows('requestAccessToken')
        ->once()
        ->with('auth_code')
        ->andReturns([
            'access_token' => 'access_token',
            'refresh_token' => 'refresh_token',
            'expires_in' => 3600,
        ]);

    $result = $this->auth->requestAccessToken('auth_code');

    expect($result)
        ->toBeArray()
        ->toHaveKey('access_token', 'access_token');
});

it('can get an access token using the credentials flow', function () {
    $this->auth->allows('requestCredentialsToken')
        ->andReturns([
            'access_token' => 'access_token',
            'token_type' => 'bearer',
            'expires_in' => 3600,
        ]);

    $result = $this->auth->requestCredentialsToken();

    expect($result)
        ->toBeArray()
        ->toHaveKey('access_token', 'access_token');
});

it('can refresh an access token', function () {
    $this->auth->allows('refreshAccessToken')
        ->once()
        ->with('refresh_token')
        ->andReturns([
            'access_token' => 'access_token',
            'refresh_token' => 'refresh_token',
            'expires_in' => 3600,
        ]);

    $result = $this->auth->refreshAccessToken('refresh_token');

    expect($result)
        ->toBeArray()
        ->toHaveKey('access_token', 'access_token');
});

it('can get the access token from the session', function () {
    Session::shouldReceive('has')
        ->once()
        ->with('spotify_access_token')
        ->andReturn(true);

    Session::shouldReceive('get')
        ->once()
        ->with('spotify_access_token')
        ->andReturn('spotify_access_token');

    $result = $this->auth->getAccessToken();

    expect($result)->toBe('spotify_access_token');
});

it('can store a new access token in the session', function () {
    Session::shouldReceive('put')
        ->once()
        ->with('spotify_access_token', 'new_access_token')
        ->andReturnNull();

    $this->auth->setAccessToken('new_access_token');
});

it('can get the refresh token from the session', function () {
    Session::shouldReceive('get')
        ->once()
        ->with('spotify_refresh_token')
        ->andReturn('spotify_refresh_token');

    $result = $this->auth->getRefreshToken();

    expect($result)->toBe('spotify_refresh_token');
});

it('can store a new refresh token in the session', function () {
    Session::shouldReceive('put')
        ->once()
        ->with('spotify_refresh_token', 'new_refresh_token')
        ->andReturnNull();

    $this->auth->setRefreshToken('new_refresh_token');
});
