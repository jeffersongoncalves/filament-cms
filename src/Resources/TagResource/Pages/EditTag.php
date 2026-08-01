<?php

namespace JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentCms\Resources\TagResource;
use JeffersonGoncalves\FilamentTranslatable\Actions\LocaleSwitcher;
use JeffersonGoncalves\FilamentTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;

class EditTag extends EditRecord
{
    use Translatable;

    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
