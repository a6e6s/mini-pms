<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'title')
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status_id')
                    ->relationship('status', 'name')
                    ->required(),
                DateTimePicker::make('due_at'),
                TextInput::make('time_estimated')
                    ->label('Estimated Time (minutes)')
                    ->numeric()
                    ->minValue(0)
                    ->suffix('min')
                    ->helperText('Estimated time to complete this task in minutes'),
                TextInput::make('time_taken')
                    ->label('Time Taken (minutes)')
                    ->numeric()
                    ->minValue(0)
                    ->suffix('min')
                    ->helperText('Actual time spent on this task in minutes'),
                FileUpload::make('attachments')
                    ->label('Attachments')
                    ->multiple()
                    ->disk('public')
                    ->directory('attachments/tasks')
                    ->fetchFileInformation(true)
                    ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])
                    ->maxSize(10240), // 10MB,
            ]);
    }
}
