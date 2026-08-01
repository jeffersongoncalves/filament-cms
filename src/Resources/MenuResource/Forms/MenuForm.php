<?php

namespace JeffersonGoncalves\FilamentCms\Resources\MenuResource\Forms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class MenuForm
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
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        TextInput::make('location')
                            ->maxLength(255)
                            ->helperText('Theme location key, e.g. "header" or "footer".'),
                    ])->columns(3),
            ]);
    }
}
