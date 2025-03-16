<img src="https://banners.beyondco.de/Spotify%20for%20Laravel.png?theme=light&packageManager=composer+require&packageName=gerenuk%2Fspotify-for-laravel&pattern=brickWall&style=style_1&description=A+Laravel+wrapper+for+the+Spotify+Web+API&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Project banner">

# Spotify for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gerenuk/spotify-for-laravel.svg?style=flat-square)](https://packagist.org/packages/gerenuk/spotify-for-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/gerenuk/spotify-for-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/gerenuk/spotify-for-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/gerenuk/spotify-for-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/gerenuk/spotify-for-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/gerenuk/spotify-for-laravel.svg?style=flat-square)](https://packagist.org/packages/gerenuk/spotify-for-laravel)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require gerenuk/spotify-for-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="spotify-for-laravel-config"
```

This is the contents of the published config file:

```php
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

```

## Usage

```php
$spotify = new Gerenuk\Spotify();
echo $spotify->echoPhrase('Hello, Gerenuk!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Kieran Proctor](https://github.com/KieranLProctor)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
