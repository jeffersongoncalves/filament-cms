<?php

use JeffersonGoncalves\FilamentCms\Resources\Categories\CategoryResource;
use JeffersonGoncalves\FilamentCms\Resources\Comments\CommentResource;
use JeffersonGoncalves\FilamentCms\Resources\Media\MediaResource;
use JeffersonGoncalves\FilamentCms\Resources\Menus\MenuResource;
use JeffersonGoncalves\FilamentCms\Resources\Pages\PageResource;
use JeffersonGoncalves\FilamentCms\Resources\Posts\PostResource;
use JeffersonGoncalves\FilamentCms\Resources\Tags\TagResource;
use JeffersonGoncalves\FilamentCms\Widgets\CmsCoreStatsWidget;

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group under which all CMS resources are listed in the
    | Filament panel. Override per-plugin with ->navigationGroup('...').
    |
    */

    'navigation_group' => 'CMS — Content',

    /*
    |--------------------------------------------------------------------------
    | Cluster
    |--------------------------------------------------------------------------
    |
    | Optionally group all resources under a Filament cluster. Set to a cluster
    | class-string to enable, or null to register resources at the top level.
    |
    */

    'cluster' => null,

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The Filament resource classes registered by the plugin. Each entry can be
    | swapped for a custom resource extending the default one.
    |
    */

    'resources' => [
        'page' => PageResource::class,
        'post' => PostResource::class,
        'category' => CategoryResource::class,
        'tag' => TagResource::class,
        'comment' => CommentResource::class,
        'media' => MediaResource::class,
        'menu' => MenuResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | The Filament widgets registered by the plugin on the panel dashboard.
    |
    */

    'widgets' => [
        'stats' => CmsCoreStatsWidget::class,
    ],

];
