<?php

namespace JeffersonGoncalves\FilamentCms\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Cms\Models\Menu;
use JeffersonGoncalves\FilamentCms\FilamentCmsPlugin;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Forms\MenuForm;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Pages\CreateMenu;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Pages\EditMenu;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Pages\ListMenus;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\RelationManagers\MenuItemsRelationManager;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Tables\MenusTable;

class MenuResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

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

    public static function form(Form $form): Form
    {
        return MenuForm::configure($form);
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
