<?php

namespace JeffersonGoncalves\FilamentCms\Concerns;

/**
 * Shared make()/get() factory helpers, the navigation-group override and the
 * swappable resource/widget override-map plumbing for the CMS plugin.
 */
trait HasCmsPluginConfig
{
    protected ?string $navigationGroup = null;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function navigationGroup(?string $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        return $this->navigationGroup
            ?? config('filament-cms.navigation_group', 'CMS — Content');
    }

    /**
     * Merge the per-resource config overrides over the plugin defaults,
     * preserving the supplied order.
     *
     * @param  array<string, class-string>  $defaults  override-key => default resource class
     * @return array<int, class-string>
     */
    protected function resolveResources(array $defaults): array
    {
        /** @var array<string, class-string> $overrides */
        $overrides = config('filament-cms.resources', []);

        return array_map(
            fn (string $key, string $default): string => $overrides[$key] ?? $default,
            array_keys($defaults),
            array_values($defaults),
        );
    }

    /**
     * @return array<int, class-string>
     */
    protected function resolveWidgets(): array
    {
        /** @var array<string, class-string> $widgets */
        $widgets = config('filament-cms.widgets', []);

        return array_values($widgets);
    }
}
