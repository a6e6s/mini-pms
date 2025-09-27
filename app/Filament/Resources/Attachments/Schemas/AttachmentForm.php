<?php

namespace App\Filament\Resources\Attachments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AttachmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('path')
                    ->required(),
                TextInput::make('model')
                    ->required(),
                TextInput::make('size')
                    ->numeric()
                    ->default(null),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->default(null),
                TextInput::make('attachable_id')
                    ->required()
                    ->numeric(),
                TextInput::make('attachable_type')
                    ->required(),
            ]);
    }
}
