<?php

use JeffersonGoncalves\Cms\Models\Category;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Pages\CreateCategory;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Pages\EditCategory;
use JeffersonGoncalves\FilamentCms\Resources\Categories\Pages\ListCategories;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the category list page', function () {
    Livewire::test(ListCategories::class)->assertSuccessful();
});

it('can list categories in the table', function () {
    $category = Category::create([
        'name' => 'News',
        'slug' => 'news',
    ]);

    Livewire::test(ListCategories::class)
        ->assertCanSeeTableRecords([$category]);
});

it('can create a category', function () {
    Livewire::test(CreateCategory::class)
        ->fillForm([
            'name' => 'Tutorials',
            'slug' => 'tutorials',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Category::query()->where('slug->en', 'tutorials')->exists())->toBeTrue();
});

it('can edit a category', function () {
    $category = Category::create([
        'name' => 'Updates',
        'slug' => 'updates',
    ]);

    Livewire::test(EditCategory::class, ['record' => $category->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['name' => 'Product Updates'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($category->refresh()->name)->toBe('Product Updates');
});
