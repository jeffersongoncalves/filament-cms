<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\Cms\Enums\CommentStatus;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make('Comment')
                    ->schema([
                        TextInput::make('author_name')
                            ->maxLength(255),
                        TextInput::make('author_email')
                            ->email()
                            ->maxLength(255),
                        Select::make('status')
                            ->options(CommentStatus::class)
                            ->required(),
                        Textarea::make('body')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
