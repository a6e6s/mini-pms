<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskObserver
{
    public function created(Task $task): void
    {
        Activity::create([
            'user_id' => Auth::id(),
            'action' => Activity::TASK_CREATED,
            'loggable_id' => $task->id,
            'loggable_type' => Task::class,
            'details' => ['task_title' => $task->title],
        ]);
    }

    public function updated(Task $task): void
    {
        $changes = $task->getChanges();
        
        if (isset($changes['status_id'])) {
            $oldStatus = $task->getOriginal('status_id');
            $newStatus = $changes['status_id'];
            
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::STATUS_CHANGED,
                'loggable_id' => $task->id,
                'loggable_type' => Task::class,
                'details' => [
                    'old_status' => \App\Models\TaskStatus::find($oldStatus)?->name ?? '',
                    'new_status' => \App\Models\TaskStatus::find($newStatus)?->name ?? '',
                ],
            ]);
        }

        if (isset($changes['due_at'])) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::DUE_DATE_CHANGED,
                'loggable_id' => $task->id,
                'loggable_type' => Task::class,
                'details' => [
                    'old_due_date' => $task->getOriginal('due_at'),
                    'new_due_date' => $changes['due_at'],
                ],
            ]);
        }

        if (isset($changes['title'])) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::TITLE_CHANGED,
                'loggable_id' => $task->id,
                'loggable_type' => Task::class,
                'details' => [
                    'old_title' => $task->getOriginal('title'),
                    'new_title' => $changes['title'],
                ],
            ]);
        }

        if (isset($changes['description'])) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::DESCRIPTION_CHANGED,
                'loggable_id' => $task->id,
                'loggable_type' => Task::class,
                'details' => [],
            ]);
        }

        if (isset($changes['project_id'])) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::PROJECT_CHANGED,
                'loggable_id' => $task->id,
                'loggable_type' => Task::class,
                'details' => [
                    'old_project' => \App\Models\Project::find($task->getOriginal('project_id'))?->title ?? '',
                    'new_project' => \App\Models\Project::find($changes['project_id'])?->title ?? '',
                ],
            ]);
        }

        if (isset($changes['time_taken'])) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::TIME_TAKEN_CHANGED,
                'loggable_id' => $task->id,
                'loggable_type' => Task::class,
                'details' => [
                    'old_time' => $task->getOriginal('time_taken') ?? 0,
                    'new_time' => $changes['time_taken'],
                ],
            ]);
        }
    }

    public function deleted(Task $task): void
    {
        Activity::create([
            'user_id' => Auth::id(),
            'action' => Activity::TASK_DELETED,
            'loggable_id' => $task->id,
            'loggable_type' => Task::class,
            'details' => ['task_title' => $task->title],
        ]);
    }
}
