<?php

use JeffersonGoncalves\Cms\Enums\PageStatus;
use JeffersonGoncalves\Cms\Models\Page;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages\CreatePage;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages\EditPage;
use JeffersonGoncalves\FilamentCms\Resources\PageResource\Pages\ListPages;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the page list page', function () {
    Livewire::test(ListPages::class)->assertSuccessful();
});

it('can list pages in the table', function () {
    $page = Page::create([
        'title' => 'Home',
        'slug' => 'home',
        'body' => 'Welcome',
        'status' => PageStatus::Draft,
    ]);

    Livewire::test(ListPages::class)
        ->assertCanSeeTableRecords([$page]);
});

it('can create a page', function () {
    Livewire::test(CreatePage::class)
        ->fillForm([
            'title' => 'About',
            'slug' => 'about',
            'body' => 'About us',
            'status' => PageStatus::Published->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Page::query()->where('slug->en', 'about')->exists())->toBeTrue();
});

it('can edit a page', function () {
    $page = Page::create([
        'title' => 'Contact',
        'slug' => 'contact',
        'body' => 'Contact us',
        'status' => PageStatus::Draft,
    ]);

    Livewire::test(EditPage::class, ['record' => $page->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['title' => 'Contact Us'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($page->refresh()->title)->toBe('Contact Us');
});
