<?php

namespace JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentCms\Resources\PageResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreatePage extends CreateRecord
{
    use Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
