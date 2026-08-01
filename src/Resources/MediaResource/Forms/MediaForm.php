<?php

namespace JeffersonGoncalves\FilamentCms\Resources\MediaResource\Forms;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class MediaForm
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
                            ->maxLength(255),
                        TextInput::make('collection_name')
                            ->disabled(),
                        TextInput::make('mime_type')
                            ->disabled(),
                    ])->columns(3),
            ]);
    }
}
