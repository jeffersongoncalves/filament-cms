<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use JeffersonGoncalves\Cms\Enums\PostStatus;

class PostForm
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
                        Textarea::make('excerpt')
                            ->rows(2)
                            ->columnSpanFull(),
                        RichEditor::make('body')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('Publishing')
                    ->schema([
                        Select::make('status')
                            ->options(PostStatus::class)
                            ->required()
                            ->default(PostStatus::Draft),
                        DateTimePicker::make('published_at'),
                        Select::make('author_id')
                            ->label('Author')
                            ->options(fn () => (config('auth.providers.users.model'))::query()->pluck('name', 'id'))
                            ->default(fn () => Auth::id())
                            ->searchable(),
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
