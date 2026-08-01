<?php

namespace JeffersonGoncalves\FilamentCms\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Enums\CommentStatus;

/**
 * Attached to any resource whose model uses the `HasComments` concern
 * (Page, Post — both expose a `comments()` MorphMany with the same shape).
 */
class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    public function form(Form $form): Form
    {
        return $form->schema([
            Select::make('status')
                ->options(CommentStatus::class)
                ->required(),
            Textarea::make('body')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('body')
            ->columns([
                TextColumn::make('author_name')
                    ->label('Author')
                    ->default('—'),
                TextColumn::make('body')
                    ->limit(60),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options(CommentStatus::class),
            ])
            ->actions([
                Actions\Action::make('approve')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record): bool => $record->status !== CommentStatus::Approved)
                    ->action(fn ($record) => $record->update(['status' => CommentStatus::Approved])),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
