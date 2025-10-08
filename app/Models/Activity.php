<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    use HasFactory;

    const TASK_CREATED = 'TASK_CREATED';
    const TASK_UPDATED = 'TASK_UPDATED';
    const TASK_DELETED = 'TASK_DELETED';
    const STATUS_CHANGED = 'STATUS_CHANGED';
    const ASSIGNEE_ADDED = 'ASSIGNEE_ADDED';
    const ASSIGNEE_REMOVED = 'ASSIGNEE_REMOVED';
    const COMMENT_ADDED = 'COMMENT_ADDED';
    const ATTACHMENT_ADDED = 'ATTACHMENT_ADDED';
    const DUE_DATE_CHANGED = 'DUE_DATE_CHANGED';
    const TITLE_CHANGED = 'TITLE_CHANGED';
    const DESCRIPTION_CHANGED = 'DESCRIPTION_CHANGED';
    const PROJECT_CHANGED = 'PROJECT_CHANGED';
    const TIME_TAKEN_CHANGED = 'TIME_TAKEN_CHANGED';

    protected $fillable = [
        'user_id',
        'action',
        'details',
        'loggable_id',
        'loggable_type',
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'user_id' => 'integer',
            'details' => 'array',
            'loggable_id' => 'integer',
            'created_at' => 'timestamp',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getHumanReadableAttribute(): string
    {
        $userName = $this->user?->name ?? __('app.activity.unknown_user');
        $details = $this->details ?? [];

        return match($this->action) {
            self::TASK_CREATED => __('app.activity.task_created', ['user' => $userName]),
            self::TASK_UPDATED => __('app.activity.task_updated', ['user' => $userName]),
            self::TASK_DELETED => __('app.activity.task_deleted', ['user' => $userName]),
            self::STATUS_CHANGED => __('app.activity.status_changed', [
                'user' => $userName,
                'old' => $details['old_status'] ?? '',
                'new' => $details['new_status'] ?? ''
            ]),
            self::ASSIGNEE_ADDED => __('app.activity.assignee_added', [
                'user' => $userName,
                'assignee' => $details['assignee_name'] ?? ''
            ]),
            self::ASSIGNEE_REMOVED => __('app.activity.assignee_removed', [
                'user' => $userName,
                'assignee' => $details['assignee_name'] ?? ''
            ]),
            self::COMMENT_ADDED => __('app.activity.comment_added', [
                'user' => $userName,
                'comment' => $details['comment'] ?? ''
            ]),
            self::ATTACHMENT_ADDED => __('app.activity.attachment_added', [
                'user' => $userName,
                'filename' => $details['filename'] ?? ''
            ]),
            self::DUE_DATE_CHANGED => __('app.activity.due_date_changed', [
                'user' => $userName,
                'old' => $details['old_due_date'] ?? '',
                'new' => $details['new_due_date'] ?? ''
            ]),
            self::TITLE_CHANGED => __('app.activity.title_changed', [
                'user' => $userName,
                'old' => $details['old_title'] ?? '',
                'new' => $details['new_title'] ?? ''
            ]),
            self::DESCRIPTION_CHANGED => __('app.activity.description_changed', ['user' => $userName]),
            self::PROJECT_CHANGED => __('app.activity.project_changed', [
                'user' => $userName,
                'old' => $details['old_project'] ?? '',
                'new' => $details['new_project'] ?? ''
            ]),
            self::TIME_TAKEN_CHANGED => __('app.activity.time_taken_changed', [
                'user' => $userName,
                'old' => $details['old_time'] ?? '',
                'new' => $details['new_time'] ?? ''
            ]),
            default => __('app.activity.unknown_action', ['user' => $userName])
        };
    }
}
