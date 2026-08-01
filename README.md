# Filament CMS

![Filament CMS](https://raw.githubusercontent.com/jeffersongoncalves/filament-cms/3.x/art/jeffersongoncalves-filament-cms.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-cms.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-cms)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-cms/tests.yml?branch=3.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-cms/actions?query=workflow%3Atests+branch%3A3.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-cms/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-cms/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A3.x)

Filament CMS UI plugin — pages, posts, categories, tags, comment moderation, media and navigation menus inside a [Filament](https://filamentphp.com) panel. Resources, actions and widgets, built on top of [`jeffersongoncalves/laravel-cms`](https://github.com/jeffersongoncalves/laravel-cms).

## Installation

```bash
composer require jeffersongoncalves/filament-cms
```

```php
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;

public function panel(Panel $panel): Panel
{
    return $panel->plugin(FilamentCmsPlugin::make());
}
```

## Versions

Pick the branch/constraint matching your Filament version:

| Filament | Branch | Constraint | Status |
|----------|--------|------------|--------|
| v5 | `3.x` | `^3.0` | Built |
| v4 | `2.x` | `^2.0` | Built |
| v3 | `1.x` | `^1.0` | Built |

## Compatibility

- **PHP** 8.2+
- **Laravel** 12.x · 13.x
- **Filament** v5 (this branch)

## Development

```bash
composer install
composer test       # Pest
composer analyse    # PHPStan level 5
composer format     # Pint
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please see [SECURITY](.github/SECURITY.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information. Built by [Jefferson Gonçalves](https://github.com/jeffersongoncalves).
