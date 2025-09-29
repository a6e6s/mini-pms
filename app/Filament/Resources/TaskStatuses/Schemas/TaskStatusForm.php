<?php

namespace App\Filament\Resources\TaskStatuses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskStatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
            ]);
    }
}
