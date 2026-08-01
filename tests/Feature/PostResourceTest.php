<?php

use JeffersonGoncalves\Cms\Enums\PostStatus;
use JeffersonGoncalves\Cms\Models\Post;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages\CreatePost;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages\EditPost;
use JeffersonGoncalves\FilamentCms\Resources\PostResource\Pages\ListPosts;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the post list page', function () {
    Livewire::test(ListPosts::class)->assertSuccessful();
});

it('can list posts in the table', function () {
    $post = Post::create([
        'title' => 'Hello World',
        'slug' => 'hello-world',
        'body' => 'First post',
        'status' => PostStatus::Draft,
    ]);

    Livewire::test(ListPosts::class)
        ->assertCanSeeTableRecords([$post]);
});

it('can create a post', function () {
    Livewire::test(CreatePost::class)
        ->fillForm([
            'title' => 'Second Post',
            'slug' => 'second-post',
            'body' => 'Body text',
            'status' => PostStatus::Published->value,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Post::query()->where('slug->en', 'second-post')->exists())->toBeTrue();
});

it('can edit a post', function () {
    $post = Post::create([
        'title' => 'Draft Post',
        'slug' => 'draft-post',
        'body' => 'Draft body',
        'status' => PostStatus::Draft,
    ]);

    Livewire::test(EditPost::class, ['record' => $post->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['title' => 'Published Post'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($post->refresh()->title)->toBe('Published Post');
});
