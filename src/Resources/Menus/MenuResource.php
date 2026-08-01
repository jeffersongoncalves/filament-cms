<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Menus;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Menu;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\Menus\Pages\CreateMenu;
use JeffersonGoncalves\FilamentCms\Resources\Menus\Pages\EditMenu;
use JeffersonGoncalves\FilamentCms\Resources\Menus\Pages\ListMenus;
use JeffersonGoncalves\FilamentCms\Resources\Menus\RelationManagers\MenuItemsRelationManager;
use JeffersonGoncalves\FilamentCms\Resources\Menus\Schemas\MenuForm;
use JeffersonGoncalves\FilamentCms\Resources\Menus\Tables\MenusTable;

class MenuResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return config('cms-menu.models.menu', Menu::class);
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
        return MenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MenuItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }
}
