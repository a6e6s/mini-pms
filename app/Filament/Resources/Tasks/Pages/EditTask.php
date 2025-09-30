<?php

namespace App\Filament\Resources\Tasks\Pages;

use App\Filament\Resources\Tasks\TaskResource;
use App\Models\Attachment;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load existing attachments for the form
        $data['attachments'] = $this->record->attachments()->pluck('path')->toArray();

        return $data;
    }

    protected function afterSave(): void
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
