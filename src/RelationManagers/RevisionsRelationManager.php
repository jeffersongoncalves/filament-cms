<?php

namespace JeffersonGoncalves\FilamentCms\RelationManagers;

use Filament\Actions;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Page;
use JeffersonGoncalves\Cms\Models\Post;

/**
 * Attached to any resource whose model uses the `HasRevisions` concern
 * (Page, Post). Read-only history with a restore action — records are
 * created automatically by the model's `updating` hook, never here.
 */
class RevisionsRelationManager extends RelationManager
{
    protected static string $relationship = 'revisions';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')
                    ->label('Changed by')
                    ->default('—'),
                TextColumn::make('created_at')
                    ->label('Recorded at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([])
            ->recordActions([
                Actions\Action::make('restore')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->requiresConfirmation()
                    ->action(function ($record): void {
                        $owner = $this->getOwnerRecord();

                        if ($owner instanceof Page || $owner instanceof Post) {
                            $owner->restoreRevision($record);
                        }
                    }),
                Actions\DeleteAction::make(),
            ]);
    }
}
