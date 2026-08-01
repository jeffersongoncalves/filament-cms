<?php

use JeffersonGoncalves\Cms\Models\Menu;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Pages\CreateMenu;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Pages\EditMenu;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource\Pages\ListMenus;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the menu list page', function () {
    Livewire::test(ListMenus::class)->assertSuccessful();
});

it('can list menus in the table', function () {
    $menu = Menu::create([
        'name' => 'Header',
        'slug' => 'header',
        'location' => 'header',
    ]);

    Livewire::test(ListMenus::class)
        ->assertCanSeeTableRecords([$menu]);
});

it('can create a menu', function () {
    Livewire::test(CreateMenu::class)
        ->fillForm([
            'name' => 'Footer',
            'slug' => 'footer',
            'location' => 'footer',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Menu::query()->where('slug', 'footer')->exists())->toBeTrue();
});

it('can edit a menu', function () {
    $menu = Menu::create([
        'name' => 'Sidebar',
        'slug' => 'sidebar',
        'location' => 'sidebar',
    ]);

    Livewire::test(EditMenu::class, ['record' => $menu->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['name' => 'Sidebar Nav'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($menu->refresh()->name)->toBe('Sidebar Nav');
});
