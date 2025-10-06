<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Attachment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttachmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Attachment');
    }

    public function view(AuthUser $authUser, Attachment $attachment): bool
    {
        return $authUser->can('View:Attachment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Attachment');
    }

    public function update(AuthUser $authUser, Attachment $attachment): bool
    {
        return $authUser->can('Update:Attachment');
    }

    public function delete(AuthUser $authUser, Attachment $attachment): bool
    {
        return $authUser->can('Delete:Attachment');
    }

    public function restore(AuthUser $authUser, Attachment $attachment): bool
    {
        return $authUser->can('Restore:Attachment');
    }

    public function forceDelete(AuthUser $authUser, Attachment $attachment): bool
    {
        return $authUser->can('ForceDelete:Attachment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Attachment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Attachment');
    }

    public function replicate(AuthUser $authUser, Attachment $attachment): bool
    {
        return $authUser->can('Replicate:Attachment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Attachment');
    }

}