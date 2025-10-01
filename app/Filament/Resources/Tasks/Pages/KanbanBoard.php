<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\Schemas\TaskForm;
use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Comment;
use App\Models\Task;
use App\Models\TaskStatus;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ViewField;
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

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('New Task')
                ->model(Task::class)
                ->form(fn ($form) => TaskForm::configure($form)),
        ];
    }

    public function updateTask($taskId, $field, $value)
    {
        $task = Task::findOrFail($taskId);
        $task->update([$field => $value]);

        $this->dispatch('task-field-updated');
    }

    public function viewTaskAction(): Action
    {
        return Action::make('viewTask')
            ->modalHeading(fn (array $arguments) => Task::find($arguments['task'])?->title ?? 'View Task')
            ->form(function (array $arguments) {
                $task = Task::with(['project', 'status', 'comments.user'])->find($arguments['task']);

                return [
                    ViewField::make('task_details')
                        ->view('filament.forms.components.inline-editable-task', [
                            'task' => $task,
                        ])
                        ->columnSpanFull(),
                ];
            })
            ->fillForm(fn (array $arguments) => [
                'task_id' => $arguments['task'],
            ])
            ->modalWidth('3xl')
            ->modalFooterActions(function (array $arguments) {
                $taskId = $arguments['task'];

                return [
                    Action::make('addComment')
                        ->label('Add Comment')
                        ->icon(Heroicon::ChatBubbleBottomCenterText)
                        ->color('primary')
                        ->form([
                            Textarea::make('comment_body')
                                ->label('Your Comment')
                                ->required()
                                ->rows(3)
                                ->placeholder('Write your comment here...'),
                        ])
                        ->action(function (array $data, Action $action) use ($taskId) {
                            Comment::create([
                                'user_id' => auth()->id(),
                                'commentable_type' => Task::class,
                                'commentable_id' => $taskId,
                                'body' => $data['comment_body'],
                            ]);
                            // Remount to refresh the view
                            $this->replaceMountedAction('viewTask', ['task' => $taskId]);
                        })
                        ->successNotificationTitle('Comment added successfully'),
                ];
            })
            ->modalSubmitAction(false)
            ->modalCancelActionLabel('Close');
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
