<?php

namespace App\Filament\Resources\TaskStatuses\Pages;

use App\Filament\Resources\TaskStatuses\TaskStatusResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTaskStatus extends EditRecord
{
    protected static string $resource = TaskStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
