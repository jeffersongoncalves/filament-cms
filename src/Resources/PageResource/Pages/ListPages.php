<?php

namespace JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentCms\Resources\PageResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListPages extends ListRecords
{
    use Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
