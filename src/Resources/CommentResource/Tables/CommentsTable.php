<?php

namespace JeffersonGoncalves\FilamentCms\Resources\CommentResource\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Enums\CommentStatus;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('commentable_type')
                    ->label('On')
                    ->formatStateUsing(fn (?string $state): string => $state ? class_basename($state) : '—')
                    ->toggleable(),
                TextColumn::make('author_name')
                    ->label('Author')
                    ->searchable()
                    ->default('—'),
                TextColumn::make('body')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Actions\Action::make('spam')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->visible(fn ($record): bool => $record->status !== CommentStatus::Spam)
                    ->action(fn ($record) => $record->update(['status' => CommentStatus::Spam])),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\BulkAction::make('approve')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->update(['status' => CommentStatus::Approved])),
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
