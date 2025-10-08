<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        if ($comment->commentable_type === Task::class) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => Activity::COMMENT_ADDED,
                'loggable_id' => $comment->commentable_id,
                'loggable_type' => Task::class,
                'details' => [
                    'comment' => substr($comment->body, 0, 100),
                ],
            ]);
        }
    }
}
