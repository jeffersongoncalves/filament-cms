<?php

namespace JeffersonGoncalves\FilamentCms;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentCms\Concerns\HasCmsPluginConfig;
use JeffersonGoncalves\FilamentCms\Resources\CategoryResource;
use JeffersonGoncalves\FilamentCms\Resources\CommentResource;
use JeffersonGoncalves\FilamentCms\Resources\MediaResource;
use JeffersonGoncalves\FilamentCms\Resources\MenuResource;
use JeffersonGoncalves\FilamentCms\Resources\PageResource;
use JeffersonGoncalves\FilamentCms\Resources\PostResource;
use JeffersonGoncalves\FilamentCms\Resources\TagResource;

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
