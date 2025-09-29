<?php

namespace App\Filament\Resources\TaskStatuses\Pages;

use App\Filament\Resources\TaskStatuses\TaskStatusResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTaskStatus extends ViewRecord
{
    protected static string $resource = TaskStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
