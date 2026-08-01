<?php

namespace JeffersonGoncalves\FilamentCms;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentCms\Concerns\HasCmsPluginConfig;
use JeffersonGoncalves\FilamentCms\Resources\Categories\CategoryResource;
use JeffersonGoncalves\FilamentCms\Resources\Comments\CommentResource;
use JeffersonGoncalves\FilamentCms\Resources\Media\MediaResource;
use JeffersonGoncalves\FilamentCms\Resources\Menus\MenuResource;
use JeffersonGoncalves\FilamentCms\Resources\Pages\PageResource;
use JeffersonGoncalves\FilamentCms\Resources\Posts\PostResource;
use JeffersonGoncalves\FilamentCms\Resources\Tags\TagResource;

class FilamentCmsPlugin implements Plugin
{
    use HasCmsPluginConfig;

    public function getId(): string
    {
        return 'filament-cms';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resolveResources([
            'page' => PageResource::class,
            'post' => PostResource::class,
            'category' => CategoryResource::class,
            'tag' => TagResource::class,
            'comment' => CommentResource::class,
            'media' => MediaResource::class,
            'menu' => MenuResource::class,
        ]));

        $panel->widgets($this->resolveWidgets());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
