# Filament CMS

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-support-FFDD00?style=flat-square&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/jeffersongoncalves)

![Filament CMS](https://raw.githubusercontent.com/jeffersongoncalves/filament-cms/3.x/art/jeffersongoncalves-filament-cms.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/filament-cms.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/filament-cms)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-cms/tests.yml?branch=3.x&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/filament-cms/actions?query=workflow%3Atests+branch%3A3.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/filament-cms/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/jeffersongoncalves/filament-cms/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3A3.x)

Filament CMS UI plugin — pages, posts, categories, tags, comment moderation, media and navigation menus inside a [Filament](https://filamentphp.com) panel. Resources, actions and widgets, built on top of [`jeffersongoncalves/laravel-cms`](https://github.com/jeffersongoncalves/laravel-cms).

## Version Compatibility

Pick the branch/constraint matching your Filament version:

| Filament | Branch | Constraint | Status |
|----------|--------|------------|--------|
| v5 | `3.x` | `^3.0` | Built |
| v4 | `2.x` | `^2.0` | Built |
| v3 | `1.x` | `^1.0` | Built |

- **PHP** 8.2+
- **Laravel** 12.x · 13.x
- **Filament** v5 (this branch)

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

## Credits

- [Jefferson Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information. Built by [Jefferson Gonçalves](https://github.com/jeffersongoncalves).
