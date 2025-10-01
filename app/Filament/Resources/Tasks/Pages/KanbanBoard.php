<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\TaskResource;
use App\Models\TaskStatus;
use BackedEnum;
use Filament\Resources\Pages\Page;
use Filament\Support\Icons\Heroicon;

class KanbanBoard extends Page
{
    protected static bool $shouldSkipAuthorization = true;

    protected static string $resource = TaskResource::class;

    protected string $view = 'filament.resources.tasks.pages.kanban-board';

    protected static ?string $navigationLabel = 'Kanban Board';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    public static function getNavigationLabel(): string
    {
        return 'Kanban Board';
    }

    public function updateTaskStatus(int $taskId, int $statusId): void
    {
        \App\Models\Task::findOrFail($taskId)->update(['status_id' => $statusId]);
    }

    protected function getViewData(): array
    {
        return [
            'statuses' => TaskStatus::with(['tasks' => function ($query) {
                $query->with(['project'])->orderBy('created_at', 'desc');
            }])->get(),
        ];
    }
}
