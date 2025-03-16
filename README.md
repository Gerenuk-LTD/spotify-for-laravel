<img src="https://banners.beyondco.de/Spotify%20for%20Laravel.png?theme=light&packageManager=composer+require&packageName=gerenuk%2Fspotify-for-laravel&pattern=brickWall&style=style_1&description=A+Laravel+wrapper+for+the+Spotify+Web+API&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="Project banner">

# Spotify for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gerenuk/spotify-for-laravel.svg?style=flat-square)](https://packagist.org/packages/gerenuk/spotify-for-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/gerenuk-ltd/spotify-for-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/gerenuk-ltd/spotify-for-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/gerenuk-ltd/spotify-for-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/gerenuk-ltd/spotify-for-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/gerenuk/spotify-for-laravel.svg?style=flat-square)](https://packagist.org/packages/gerenuk/spotify-for-laravel)

Spotify for Laravel is an easy-to-use [Spotify Web API](https://developer.spotify.com/documentation/web-api) wrapper for Laravel, providing methods for each endpoint and a fluent interface for optional parameters. It is based on [aerni/laravel-spotify](https://github.com/aerni/laravel-spotify) adding support for the ['Authorization Code Flow'](https://developer.spotify.com/documentation/web-api/tutorials/code-flow).

> [!NOTE]
> This package is still under development and may not support all endpoints.

## Table of Contents
1. [Introduction](#spotify-for-laravel)
2. [Version Compatability](#version-compatability)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Testing](#testing)
6. [Changelog](#changelog)
7. [Contributing](#contributing)
8. [Security Vulnerabilities](#security-vulnerabilities)
9. [Credits](#credits)
10. [License](#license)

## Version Compatability

| Plugin | PHP |
|--------|-----|
| 1.x    | 8.x |

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

Set the `Client ID` and `Client Secret` of your [Spotify App](https://developer.spotify.com/dashboard) in your `.env` file.

```env
SPOTIFY_CLIENT_ID=********************************
SPOTIFY_CLIENT_SECRET=********************************
```

> [!NOTE]
> You will need to set the 'scope' and 'redirect_uri' if using endpoints that access user data.

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

- Modified version of [laravel-spotify](https://github.com/aerni/laravel-spotify) from [aerni](https://github.com/aerni)
- [Kieran Proctor](https://github.com/KieranLProctor)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
