<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Comments;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Enums\CommentStatus;
use JeffersonGoncalves\Cms\Models\Comment;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\Comments\Pages\EditComment;
use JeffersonGoncalves\FilamentCms\Resources\Comments\Pages\ListComments;
use JeffersonGoncalves\FilamentCms\Resources\Comments\Schemas\CommentForm;
use JeffersonGoncalves\FilamentCms\Resources\Comments\Tables\CommentsTable;

class CommentResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

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

    public static function form(Schema $schema): Schema
    {
        return CommentForm::configure($schema);
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
