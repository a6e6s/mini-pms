<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\Schemas\TaskForm;
use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Task;
use App\Models\TaskStatus;
use BackedEnum;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Section;
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

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('New Task')
                ->model(Task::class)
                ->schema([
                    Section::make('Task Details')
                        ->columns(2)
                        ->schema([
                            Select::make('project_id')
                                ->searchable()
                                ->relationship('project', 'title')
                                ->required()
                                ->preload(),
                            TextInput::make('title')
                                ->required(),
                            Textarea::make('description')
                                ->default(null)
                                ->columnSpanFull(),
                            Select::make('status_id')
                                ->relationship('status', 'name')->default(1)
                                ->required(),
                            FileUpload::make('attachments')
                                ->label('Attachments')
                                ->multiple()
                                ->disk('public')
                                ->directory('attachments/tasks')
                                ->fetchFileInformation(true)
                                ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])
                                ->maxSize(10240), // 10MB,
                            DateTimePicker::make('due_at'),
                            TextInput::make('time_estimated')
                                ->label('Estimated Time (minutes)')
                                ->numeric()
                                ->minValue(0)
                                ->suffix('min')
                                ->helperText('Estimated time to complete this task in minutes'),
                        ])
                ])
        ];
    }

    public function updateTaskStatus(int $taskId, int $statusId): void
    {
        Task::findOrFail($taskId)->update(['status_id' => $statusId]);
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
