<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\TaskStatus;
use Livewire\Component;

class KanbanBoard extends Component
{
    public function updateTaskStatus(int $taskId, int $statusId): void
    {
        $task = Task::findOrFail($taskId);
        $task->update(['status_id' => $statusId]);

        $this->dispatch('task-moved');
    }

    public function render()
    {
        $statuses = TaskStatus::with(['tasks' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->get();

        $tasks = Task::with(['status', 'project'])->get()->groupBy('status_id');

        return view('livewire.tasks.kanban-board', [
            'statuses' => $statuses,
            'tasks' => $tasks,
        ]);
    }
}
