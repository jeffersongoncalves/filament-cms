<?php

namespace JeffersonGoncalves\FilamentCms\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentCms\Resources\CategoryResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateCategory extends CreateRecord
{
    use Translatable;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
