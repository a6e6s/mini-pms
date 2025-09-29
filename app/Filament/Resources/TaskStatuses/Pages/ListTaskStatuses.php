<?php

namespace App\Filament\Resources\TaskStatuses\Pages;

use App\Filament\Resources\TaskStatuses\TaskStatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTaskStatuses extends ListRecords
{
    protected static string $resource = TaskStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
