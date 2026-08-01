<?php

namespace JeffersonGoncalves\FilamentCms\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Category;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\CategoryResource\Forms\CategoryForm;
use JeffersonGoncalves\FilamentCms\Resources\CategoryResource\Pages\CreateCategory;
use JeffersonGoncalves\FilamentCms\Resources\CategoryResource\Pages\EditCategory;
use JeffersonGoncalves\FilamentCms\Resources\CategoryResource\Pages\ListCategories;
use JeffersonGoncalves\FilamentCms\Resources\CategoryResource\Tables\CategoriesTable;
use JeffersonGoncalves\FilamentTranslatable\Resources\Concerns\Translatable;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('cms-core.models.category', Category::class);
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentCmsPlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-cms.navigation_group', 'CMS — Content');
        }
    }

    public static function form(Form $form): Form
    {
        return CategoryForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
