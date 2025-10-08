<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Attachment;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class AttachmentObserver
{
    public function created(Attachment $attachment): void
    {
        if ($attachment->attachable_type === Task::class) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::ATTACHMENT_ADDED,
                'loggable_id' => $attachment->attachable_id,
                'loggable_type' => Task::class,
                'details' => [
                    'filename' => $attachment->name,
                ],
            ]);
        }
    }
}
