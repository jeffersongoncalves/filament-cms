<?php

namespace JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentCms\Resources\PostResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditPost extends EditRecord
{
    use Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
