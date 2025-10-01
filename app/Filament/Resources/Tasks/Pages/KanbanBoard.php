<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\Schemas\TaskForm;
use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Navigation\Tab;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class KanbanBoard extends Page
{
    protected static bool $shouldSkipAuthorization = true;

    protected static string $resource = TaskResource::class;

    protected string $view = 'filament.resources.tasks.pages.kanban-board';

    public ?string $activeTab = 'all';

    public ?int $selectedProject = null;

    public ?int $selectedUser = null;

    public function mount(): void
    {
        $this->activeTab = 'all';
        $this->selectedProject = null;
        $this->selectedUser = null;
    }

    #[On('filter-tasks')]
    public function filterTasks(): void
    {
        // The view data will be automatically re-computed
        $this->dispatch('$refresh');
    }

    public function setActiveTab(string $tabId): void
    {
        $this->activeTab = $tabId;
        $this->selectedProject = null;
        $this->selectedUser = null;
        $this->dispatch('filter-tasks');
    }

    public function updatedSelectedProject($value): void
    {
        $this->selectedProject = $value ?: null;
        $this->dispatch('filter-tasks');
    }

    public function updatedSelectedUser($value): void
    {
        $this->selectedUser = $value ?: null;
        $this->dispatch('filter-tasks');
    }

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
                                'user_id' => Auth::id(),
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
        $this->dispatch('filter-tasks');
    }

    protected function getViewData(): array
    {
        return [
            'statuses' => TaskStatus::with(['tasks' => function ($query) {
                $query->with(['project', 'users'])
                    ->when($this->selectedProject, fn (Builder $query) =>
                        $query->where('project_id', $this->selectedProject)
                    )
                    ->when($this->selectedUser, fn (Builder $query) =>
                        $query->whereHas('users', fn ($q) =>
                            $q->where('users.id', $this->selectedUser)
                        )
                    )
                    ->when($this->activeTab === 'my-tasks', fn (Builder $query) =>
                        $query->whereHas('users', fn ($q) =>
                            $q->where('users.id', Auth::id())
                        )
                    )
                    ->when($this->activeTab === 'my-projects', fn (Builder $query) =>
                        $query->whereHas('project', fn ($q) =>
                            $q->where('owner_id', Auth::id())
                        )
                    )
                    ->orderBy('created_at', 'desc');
            }])->get(),
            'projects' => Project::query()
                ->when($this->activeTab === 'my-projects', fn (Builder $query) =>
                    $query->where('owner_id', Auth::id())
                )
                ->get(),
            'users' => User::all(),
            'activeTab' => $this->activeTab,
            'selectedProject' => $this->selectedProject,
            'selectedUser' => $this->selectedUser,
        ];
    }
}