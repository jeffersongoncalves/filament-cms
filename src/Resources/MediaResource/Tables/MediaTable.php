<?php

namespace JeffersonGoncalves\FilamentCms\Resources\MediaResource\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('preview')
                    ->label('')
                    ->state(fn (Media $record): ?string => $record->hasGeneratedConversion('thumb') ? $record->getUrl('thumb') : ($record->hasGeneratedConversion('thumbnail') ? $record->getUrl('thumbnail') : null))
                    ->square(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('collection_name')
                    ->badge()
                    ->sortable(),
                TextColumn::make('model_type')
                    ->label('Attached to')
                    ->formatStateUsing(fn (?string $state): string => $state ? class_basename($state) : '—')
                    ->toggleable(),
                TextColumn::make('size')
                    ->label('Size')
                    ->formatStateUsing(fn (int $state): string => number_format($state / 1024, 1).' KB')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Uploaded at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('collection_name')
                    ->options(fn () => Media::query()->distinct()->pluck('collection_name', 'collection_name')->all()),
            ])
            ->actions([
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
