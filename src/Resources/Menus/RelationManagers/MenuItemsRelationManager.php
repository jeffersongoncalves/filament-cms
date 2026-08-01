<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Menus\RelationManagers;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use JeffersonGoncalves\FilamentTranslatable\Resources\RelationManagers\Concerns\Translatable;
use JeffersonGoncalves\FilamentTranslatable\Tables\Actions\LocaleSwitcher;

class MenuItemsRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'label';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('label')
                ->required()
                ->maxLength(255),
            TextInput::make('url')
                ->maxLength(255)
                ->helperText('Absolute URL or a site-relative path, e.g. "/about".'),
            Select::make('target')
                ->options([
                    '_self' => 'Same window',
                    '_blank' => 'New window',
                ])
                ->default('_self')
                ->required(),
            Select::make('parent_id')
                ->label('Parent Item')
                ->relationship('parent', 'id', fn ($query) => $query->where('menu_id', $this->getOwnerRecord()->getKey()))
                ->getOptionLabelFromRecordUsing(fn ($record) => $record->label)
                ->searchable()
                ->preload()
                ->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                TextColumn::make('label'),
                TextColumn::make('url')
                    ->toggleable(),
                TextColumn::make('target')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('parent.label')
                    ->label('Parent')
                    ->toggleable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->headerActions([
                LocaleSwitcher::make(),
                Actions\CreateAction::make(),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
