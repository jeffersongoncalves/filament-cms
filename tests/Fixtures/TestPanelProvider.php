<?php

namespace JeffersonGoncalves\FilamentCms\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentTranslatable\FilamentTranslatablePlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                FilamentTranslatablePlugin::make()->defaultLocales(['en']),
                FilamentCmsPlugin::make(),
            ]);
    }
}
