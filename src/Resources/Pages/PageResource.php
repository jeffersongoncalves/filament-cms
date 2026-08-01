<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Pages;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Page;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\RelationManagers\CommentsRelationManager;
use JeffersonGoncalves\FilamentCms\RelationManagers\RevisionsRelationManager;
use JeffersonGoncalves\FilamentCms\Resources\Pages\Pages\CreatePage;
use JeffersonGoncalves\FilamentCms\Resources\Pages\Pages\EditPage;
use JeffersonGoncalves\FilamentCms\Resources\Pages\Pages\ListPages;
use JeffersonGoncalves\FilamentCms\Resources\Pages\Schemas\PageForm;
use JeffersonGoncalves\FilamentCms\Resources\Pages\Tables\PagesTable;
use JeffersonGoncalves\FilamentTranslatable\Resources\Concerns\Translatable;

class PageResource extends Resource
{
    use Translatable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getModel(): string
    {
        return config('cms-core.models.page', Page::class);
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
        return PageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class,
            RevisionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
