<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Models\Task;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('project.title')
                    ->label('Project'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status.name')
                    ->label('Status'),
                TextEntry::make('due_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Task $record): bool => $record->trashed()),
                RepeatableEntry::make('attachments')
                    ->label('Attachments')
                    ->schema([
                        TextEntry::make('name')
                            ->label('File Name')
                            ->url(fn ($record) => asset('storage/' . $record->path))
                            ->openUrlInNewTab(),
                        TextEntry::make('size')
                            ->label('Size')
                            ->formatStateUsing(fn ($state) => $state ? number_format($state / 1024, 2) . ' KB' : 'Unknown'),
                    ])
                    ->columnSpanFull()
                    ->visible(fn (Task $record): bool => $record->attachments()->exists()),
            ]);
    }
}
