<?php

namespace JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentCms\Resources\PageResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditPage extends EditRecord
{
    use Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
