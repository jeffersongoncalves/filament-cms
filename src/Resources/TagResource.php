<?php

namespace JeffersonGoncalves\FilamentCms\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Tag;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Forms\TagForm;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages\CreateTag;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages\EditTag;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages\ListTags;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Tables\TagsTable;
use JeffersonGoncalves\FilamentTranslatable\Resources\Concerns\Translatable;

class TagResource extends Resource
{
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

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

    public static function form(Form $form): Form
    {
        return TagForm::configure($form);
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
