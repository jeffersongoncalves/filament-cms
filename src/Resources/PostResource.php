<?php

namespace JeffersonGoncalves\FilamentCms\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Post;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\RelationManagers\CommentsRelationManager;
use JeffersonGoncalves\FilamentCms\RelationManagers\RevisionsRelationManager;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Forms\PostForm;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages\CreatePost;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages\EditPost;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages\ListPosts;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Tables\PostsTable;
use JeffersonGoncalves\FilamentTranslatable\Resources\Concerns\Translatable;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getModel(): string
    {
        return config('cms-core.models.post', Post::class);
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
        return PostForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}
