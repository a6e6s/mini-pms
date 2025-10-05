<?php

namespace App\Filament\Resources\TaskStatuses\Schemas;

use App\Enums\TaskStatusColors;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class TaskStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('app.fields.name'))
                    ->required(),
                Select::make('color')
                    ->label(__('app.fields.color'))
                    ->options(TaskStatusColors::class)
                    ->required()
                    ->native(false),
                Toggle::make('is_active')
                    ->label(__('app.fields.status'))
                    ->default(true)
                    ->required(),
            ]);
    }
}
