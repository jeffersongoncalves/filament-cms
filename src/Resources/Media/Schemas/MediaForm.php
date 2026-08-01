<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Media\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
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
