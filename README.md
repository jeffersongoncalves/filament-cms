# Filament CMS

![Filament CMS](https://raw.githubusercontent.com/jeffersongoncalves/filament-cms/3.x/art/jeffersongoncalves-filament-cms.png)

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
| v4 | `2.x` | `^2.0` | Planned |
| v3 | `1.x` | `^1.0` | Planned |

## Compatibility

- **PHP** 8.2+
- **Laravel** 11.x · 12.x · 13.x
- **Filament** v5 (this branch)

## Development

```bash
composer install
composer test       # Pest
composer analyse    # PHPStan level 5
composer format     # Pint
```

## License

The MIT License (MIT). Built by [Jefferson Gonçalves](https://github.com/jeffersongoncalves).
