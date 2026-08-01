<?php

use JeffersonGoncalves\Cms\Models\Tag;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages\CreateTag;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages\EditTag;
use JeffersonGoncalves\FilamentCms\Resources\TagResource\Pages\ListTags;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the tag list page', function () {
    Livewire::test(ListTags::class)->assertSuccessful();
});

it('can list tags in the table', function () {
    $tag = Tag::create([
        'name' => 'Laravel',
        'slug' => 'laravel',
    ]);

    Livewire::test(ListTags::class)
        ->assertCanSeeTableRecords([$tag]);
});

it('can create a tag', function () {
    Livewire::test(CreateTag::class)
        ->fillForm([
            'name' => 'Filament',
            'slug' => 'filament',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Tag::query()->where('slug->en', 'filament')->exists())->toBeTrue();
});

it('can edit a tag', function () {
    $tag = Tag::create([
        'name' => 'PHP',
        'slug' => 'php',
    ]);

    Livewire::test(EditTag::class, ['record' => $tag->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['name' => 'PHP 8'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($tag->refresh()->name)->toBe('PHP 8');
});
