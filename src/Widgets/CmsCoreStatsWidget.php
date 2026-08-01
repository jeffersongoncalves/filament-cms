<?php

namespace JeffersonGoncalves\FilamentCms\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Cms\Enums\CommentStatus;
use JeffersonGoncalves\Cms\Enums\PageStatus;
use JeffersonGoncalves\Cms\Enums\PostStatus;
use JeffersonGoncalves\Cms\Models\Comment;
use JeffersonGoncalves\Cms\Models\Page;
use JeffersonGoncalves\Cms\Models\Post;

class CmsCoreStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $pageModel = config('cms-core.models.page', Page::class);
        $postModel = config('cms-core.models.post', Post::class);
        $commentModel = config('cms-core.models.comment', Comment::class);

        return [
            Stat::make('Published Pages', $pageModel::query()->where('status', PageStatus::Published)->count()),
            Stat::make('Published Posts', $postModel::query()->where('status', PostStatus::Published)->count()),
            Stat::make('Pending Comments', $commentModel::query()->where('status', CommentStatus::Pending)->count()),
        ];
    }
}
