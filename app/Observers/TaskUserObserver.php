<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Task;
use App\Models\TaskUser;
use Illuminate\Support\Facades\Auth;

class TaskUserObserver
{
    public function created(TaskUser $taskUser): void
    {
        Activity::create([
            'user_id' => Auth::id(),
            'action' => Activity::ASSIGNEE_ADDED,
            'loggable_id' => $taskUser->task_id,
            'loggable_type' => Task::class,
            'details' => [
                'assignee_name' => $taskUser->user->name,
                'assignee_id' => $taskUser->user_id,
            ],
        ]);
    }

    public function deleted(TaskUser $taskUser): void
    {
        Activity::create([
            'user_id' => Auth::id(),
            'action' => Activity::ASSIGNEE_REMOVED,
            'loggable_id' => $taskUser->task_id,
            'loggable_type' => Task::class,
            'details' => [
                'assignee_name' => $taskUser->user->name,
                'assignee_id' => $taskUser->user_id,
            ],
        ]);
    }
}
