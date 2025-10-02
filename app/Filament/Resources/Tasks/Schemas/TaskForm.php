<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Models\User;
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
                    ->label(__('app.fields.project'))
                    ->searchable()
                    ->preload()
                    ->relationship('project', 'title')
                    ->required(),
                TextInput::make('title')
                    ->label(__('app.fields.title'))
                    ->required(),
                Textarea::make('description')
                    ->label(__('app.fields.description'))
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status_id')
                    ->label(__('app.fields.status'))
                    ->default(1)
                    ->relationship('status', 'name')
                    ->required(),
                DateTimePicker::make('due_at')
                    ->label(__('app.fields.due_at')),
                TextInput::make('time_estimated')
                    ->label(__('app.fields.time_estimated'))
                    ->numeric()
                    ->minValue(0)
                    ->suffix(__('app.kanban.minutes'))
                    ->helperText(__('app.form.estimated_time_help')),
                // TextInput::make('time_taken')
                //     ->label('Time Taken (minutes)')
                //     ->numeric()
                //     ->minValue(0)
                //     ->suffix('min')
                //     ->helperText('Actual time spent on this task in minutes'),
                Select::make('user_id')
                    ->label(__('app.fields.select_user'))
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->multiple()
                    ->required(),
                FileUpload::make('attachments')
                    ->label(__('app.fields.attachments'))
                    ->multiple()
                    ->disk('public')
                    ->directory('attachments/tasks')
                    ->fetchFileInformation(true)
                    ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])
                    ->maxSize(10240)
                    ->helperText(__('app.form.max_file_size') . ' - ' . __('app.form.accepted_file_types')),
            ]);
    }
}
