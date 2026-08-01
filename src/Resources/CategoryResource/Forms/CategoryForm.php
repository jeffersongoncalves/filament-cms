<?php

namespace JeffersonGoncalves\FilamentCms\Resources\CategoryResource\Forms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class CategoryForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', str($state)->slug())),
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Select::make('parent_id')
                            ->label('Parent Category')
                            ->relationship('parent', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->name)
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        TextInput::make('order')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }
}
