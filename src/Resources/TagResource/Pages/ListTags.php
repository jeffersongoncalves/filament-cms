<?php

namespace JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentCms\Resources\TagResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListTags extends ListRecords
{
    use Translatable;

    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
