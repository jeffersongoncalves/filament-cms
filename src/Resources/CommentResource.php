<?php

namespace JeffersonGoncalves\FilamentCms\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Enums\CommentStatus;
use JeffersonGoncalves\Cms\Models\Comment;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\CommentResource\Forms\CommentForm;
use JeffersonGoncalves\FilamentCms\Resources\CommentResource\Pages\EditComment;
use JeffersonGoncalves\FilamentCms\Resources\CommentResource\Pages\ListComments;
use JeffersonGoncalves\FilamentCms\Resources\CommentResource\Tables\CommentsTable;

class CommentResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'body';

    public static function getModel(): string
    {
        return config('cms-core.models.comment', Comment::class);
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentCmsPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-cms.navigation_group', 'CMS — Content');
        }
    }

    public static function getNavigationBadge(): ?string
    {
        $pending = static::getModel()::query()
            ->where('status', CommentStatus::Pending)
            ->count();

        return $pending > 0 ? (string) $pending : null;
    }

    public static function form(Form $form): Form
    {
        return CommentForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return CommentsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComments::route('/'),
            'edit' => EditComment::route('/{record}/edit'),
        ];
    }
}
