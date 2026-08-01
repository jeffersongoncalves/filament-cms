<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Tags;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Tag;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\Tags\Pages\CreateTag;
use JeffersonGoncalves\FilamentCms\Resources\Tags\Pages\EditTag;
use JeffersonGoncalves\FilamentCms\Resources\Tags\Pages\ListTags;
use JeffersonGoncalves\FilamentCms\Resources\Tags\Schemas\TagForm;
use JeffersonGoncalves\FilamentCms\Resources\Tags\Tables\TagsTable;
use JeffersonGoncalves\FilamentTranslatable\Resources\Concerns\Translatable;

class TagResource extends Resource
{
    use Translatable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('cms-core.models.tag', Tag::class);
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentCmsPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-cms.navigation_group', 'CMS — Content');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return TagForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TagsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTags::route('/'),
            'create' => CreateTag::route('/create'),
            'edit' => EditTag::route('/{record}/edit'),
        ];
    }
}
