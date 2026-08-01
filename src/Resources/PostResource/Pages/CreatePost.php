<?php

namespace JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentCms\Resources\PostResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreatePost extends CreateRecord
{
    use Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
