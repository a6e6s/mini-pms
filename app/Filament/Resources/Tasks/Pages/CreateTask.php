<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Attachment;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function afterCreate(): void
    {
        $attachments = $this->data['attachments'] ?? [];

        if (!empty($attachments)) {
            foreach ($attachments as $attachment) {
                // Check if this is a new attachment (not already in database)
                if (!$this->record->attachments()->where('path', $attachment)->exists()) {
                    $this->record->attachments()->create([
                        'name' => basename($attachment),
                        'path' => $attachment,
                        'model' => get_class($this->record),
                        'size' => Storage::disk('public')->size($attachment) ?? 0,
                        'user_id' => auth()->id(),
                    ]);
                }
            }
        }
    }
}
