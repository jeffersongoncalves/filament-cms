<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Categories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Category;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Pages\CreateCategory;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Pages\EditCategory;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Pages\ListCategories;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Schemas\CategoryForm;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Tables\CategoriesTable;
use JeffersonGoncalves\FilamentTranslatable\Resources\Concerns\Translatable;

class CategoryResource extends Resource
{
    use Translatable;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

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

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
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
