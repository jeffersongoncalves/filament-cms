<?php

namespace JeffersonGoncalves\FilamentCms\Resources\PostResource\Forms;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use JeffersonGoncalves\Cms\Enums\PostStatus;

class PostForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
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
