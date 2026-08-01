<?php

namespace JeffersonGoncalves\FilamentCms\Resources\Comments\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentCms\Resources\Comments\CommentResource;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;
}
