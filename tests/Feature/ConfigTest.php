<?php

it('loads the filament-cms config file', function () {
    expect(config('filament-cms'))->toBeArray();
});

it('has a default navigation group', function () {
    expect(config('filament-cms.navigation_group'))->toBe('CMS — Content');
});

it('registers all standalone resources in config', function () {
    $resources = config('filament-cms.resources');

    expect($resources)->toBeArray()
        ->toHaveKeys([
            'page',
            'post',
            'category',
            'tag',
            'comment',
            'media',
            'menu',
        ]);
});

it('registers the stats widget in config', function () {
    expect(config('filament-cms.widgets'))->toBeArray()
        ->toHaveKey('stats');
});
