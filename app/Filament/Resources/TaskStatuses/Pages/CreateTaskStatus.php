<?php

namespace App\Filament\Resources\TaskStatuses\Pages;

use App\Filament\Resources\TaskStatuses\TaskStatusResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTaskStatus extends CreateRecord
{
    protected static string $resource = TaskStatusResource::class;
}
