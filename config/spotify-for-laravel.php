<?php

return [
    'api_url' => 'https://api.spotify.com/v1',

    'auth' => [
        'client_id' => env('SPOTIFY_CLIENT_ID'),
        'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
        'redirect_uri' => '',
        'scope' => [],
        'show_dialog' => false,
    ],

    'default_config' => [
        'country' => null,
        'locale' => null,
        'market' => null,
    ],
];
