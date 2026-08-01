<?php

use JeffersonGoncalves\Cms\Enums\CommentStatus;
use JeffersonGoncalves\Cms\Enums\PageStatus;
use JeffersonGoncalves\Cms\Models\Page;
use JeffersonGoncalves\FilamentCms\Resources\Comments\Pages\EditComment;
use JeffersonGoncalves\FilamentCms\Resources\Comments\Pages\ListComments;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the comment list page', function () {
    Livewire::test(ListComments::class)->assertSuccessful();
});

it('can list comments in the table', function () {
    $page = Page::create(['title' => 'Home', 'slug' => 'home', 'body' => 'x', 'status' => PageStatus::Draft]);

    $comment = $page->comments()->create([
        'author_name' => 'Jane',
        'author_email' => 'jane@example.com',
        'body' => 'Great page!',
        'status' => CommentStatus::Pending,
    ]);

    Livewire::test(ListComments::class)
        ->assertCanSeeTableRecords([$comment]);
});

it('can edit a comment', function () {
    $page = Page::create(['title' => 'Home', 'slug' => 'home', 'body' => 'x', 'status' => PageStatus::Draft]);

    $comment = $page->comments()->create([
        'author_name' => 'Jane',
        'body' => 'Pending comment',
        'status' => CommentStatus::Pending,
    ]);

    Livewire::test(EditComment::class, ['record' => $comment->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['status' => CommentStatus::Approved->value])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($comment->refresh()->status)->toBe(CommentStatus::Approved);
});

it('can approve a comment from the table action', function () {
    $page = Page::create(['title' => 'Home', 'slug' => 'home', 'body' => 'x', 'status' => PageStatus::Draft]);

    $comment = $page->comments()->create([
        'author_name' => 'Jane',
        'body' => 'Needs moderation',
        'status' => CommentStatus::Pending,
    ]);

    Livewire::test(ListComments::class)
        ->callTableAction('approve', $comment);

    expect($comment->refresh()->status)->toBe(CommentStatus::Approved);
});
