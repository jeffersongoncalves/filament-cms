<?php

use JeffersonGoncalves\FilamentCms\Resources\MediaResource\Pages\EditMedia;
use JeffersonGoncalves\FilamentCms\Resources\MediaResource\Pages\ListMedia;
use Livewire\Livewire;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the media list page', function () {
    Livewire::test(ListMedia::class)->assertSuccessful();
});

it('can list media in the table', function () {
    $media = Media::create([
        'model_type' => 'App\\Models\\Post',
        'model_id' => 1,
        'collection_name' => 'images',
        'name' => 'cover',
        'file_name' => 'cover.jpg',
        'mime_type' => 'image/jpeg',
        'disk' => 'local',
        'size' => 1024,
        'manipulations' => [],
        'custom_properties' => [],
        'generated_conversions' => [],
        'responsive_images' => [],
    ]);

    Livewire::test(ListMedia::class)
        ->assertCanSeeTableRecords([$media]);
});

it('can rename media', function () {
    $media = Media::create([
        'model_type' => 'App\\Models\\Post',
        'model_id' => 1,
        'collection_name' => 'images',
        'name' => 'cover',
        'file_name' => 'cover.jpg',
        'mime_type' => 'image/jpeg',
        'disk' => 'local',
        'size' => 1024,
        'manipulations' => [],
        'custom_properties' => [],
        'generated_conversions' => [],
        'responsive_images' => [],
    ]);

    Livewire::test(EditMedia::class, ['record' => $media->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['name' => 'cover-updated'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($media->refresh()->name)->toBe('cover-updated');
});
