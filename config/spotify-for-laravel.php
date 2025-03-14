<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Base URL
    |--------------------------------------------------------------------------
    |
    | Here you may define the base URL of the Spotify API.
    |
    */

    'api_url' => 'https://api.spotify.com/v1',


    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    |
    | Here you may define the required settings depending on which auth flow
    | you are using.
    |
    */

    'auth' => [
        'client_id' => env('SPOTIFY_CLIENT_ID'),
        'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        'redirect_uri' => '',
        'scope' => [],
        'show_dialog' => false,
    ],


    /*
    |--------------------------------------------------------------------------
    | Default Config
    |--------------------------------------------------------------------------
    |
    | You may define a default country, locale and market that will be used
    | for your Spotify API requests.
    |
    */

    'default_config' => [
        'country' => null,
        'locale' => null,
        'market' => null,
    ],
];
