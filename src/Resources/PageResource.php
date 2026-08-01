<?php

namespace JeffersonGoncalves\FilamentCms\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Page;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\RelationManagers\CommentsRelationManager;
use JeffersonGoncalves\FilamentCms\RelationManagers\RevisionsRelationManager;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Forms\PageForm;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages\CreatePage;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages\EditPage;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages\ListPages;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Tables\PagesTable;
use JeffersonGoncalves\FilamentTranslatable\Resources\Concerns\Translatable;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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

    public static function form(Form $form): Form
    {
        return PageForm::configure($form);
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
