<?php

namespace App\Filament\Resources\TaskStatuses\Schemas;

use App\Models\TaskStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TaskStatusInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (TaskStatus $record): bool => $record->trashed()),
            ]);
    }
}
