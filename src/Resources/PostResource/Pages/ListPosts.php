<?php

namespace JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentCms\Resources\PostResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListPosts extends ListRecords
{
    use Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
