<?php

namespace JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentCms\Resources\TagResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateTag extends CreateRecord
{
    use Translatable;

    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
