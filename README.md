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
