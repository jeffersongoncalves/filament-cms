<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Cms\Enums\PageStatus;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str($state)->slug())),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Select::make('parent_id')
                            ->label('Parent Page')
                            ->relationship('parent', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->title)
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        RichEditor::make('body')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('Publishing')
                    ->schema([
                        Select::make('status')
                            ->options(PageStatus::class)
                            ->required()
                            ->default(PageStatus::Draft),
                        DateTimePicker::make('published_at'),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0),
                    ])->columns(3),
                Section::make('Taxonomy')
                    ->schema([
                        Select::make('categories')
                            ->relationship('categories', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        Select::make('tags')
                            ->relationship('tags', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                            ->multiple()
                            ->searchable()
                            ->preload(),
                    ])->columns(2),
            ]);
    }
}
