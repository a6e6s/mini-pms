<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\TaskStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:TaskStatus');
    }

    public function view(AuthUser $authUser, TaskStatus $taskStatus): bool
    {
        return $authUser->can('View:TaskStatus');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:TaskStatus');
    }

    public function update(AuthUser $authUser, TaskStatus $taskStatus): bool
    {
        return $authUser->can('Update:TaskStatus');
    }

    public function delete(AuthUser $authUser, TaskStatus $taskStatus): bool
    {
        return $authUser->can('Delete:TaskStatus');
    }

    public function restore(AuthUser $authUser, TaskStatus $taskStatus): bool
    {
        return $authUser->can('Restore:TaskStatus');
    }

    public function forceDelete(AuthUser $authUser, TaskStatus $taskStatus): bool
    {
        return $authUser->can('ForceDelete:TaskStatus');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:TaskStatus');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:TaskStatus');
    }

    public function replicate(AuthUser $authUser, TaskStatus $taskStatus): bool
    {
        return $authUser->can('Replicate:TaskStatus');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:TaskStatus');
    }

}