<?php

namespace JeffersonGoncalves\FilamentCms\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\MediaResource\Forms\MediaForm;
use JeffersonGoncalves\FilamentCms\Resources\MediaResource\Pages\EditMedia;
use JeffersonGoncalves\FilamentCms\Resources\MediaResource\Pages\ListMedia;
use JeffersonGoncalves\FilamentCms\Resources\MediaResource\Tables\MediaTable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return Media::class;
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentCmsPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-cms.navigation_group', 'CMS — Content');
        }
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return MediaForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return MediaTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMedia::route('/'),
            'edit' => EditMedia::route('/{record}/edit'),
        ];
    }
}
