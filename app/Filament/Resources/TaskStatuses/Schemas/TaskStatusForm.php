<?php

namespace App\Filament\Resources\TaskStatuses\Schemas;

use App\Enums\TaskStatusColors;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TaskStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('color')
                    ->options(TaskStatusColors::class)
                    ->required()
                    ->native(false),
            ]);
    }
}
