<?php

use JeffersonGoncalves\Cms\Models\Menu;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Pages\EditMenu;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\RelationManagers\MenuItemsRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can list menu items for a menu', function () {
    $menu = Menu::create(['name' => 'Header', 'slug' => 'header', 'location' => 'header']);

    $item = $menu->items()->create([
        'label' => 'Home',
        'url' => '/',
        'target' => '_self',
        'order' => 1,
    ]);

    Livewire::test(MenuItemsRelationManager::class, [
        'ownerRecord' => $menu,
        'pageClass' => EditMenu::class,
    ])->assertCanSeeTableRecords([$item]);
});

it('can create a menu item', function () {
    $menu = Menu::create(['name' => 'Header', 'slug' => 'header', 'location' => 'header']);

    Livewire::test(MenuItemsRelationManager::class, [
        'ownerRecord' => $menu,
        'pageClass' => EditMenu::class,
    ])
        ->callTableAction('create', data: [
            'label' => 'About',
            'url' => '/about',
            'target' => '_self',
        ])
        ->assertHasNoTableActionErrors();

    expect($menu->items()->count())->toBe(1);
});
