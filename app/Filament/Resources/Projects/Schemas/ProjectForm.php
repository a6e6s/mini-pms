<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->columnSpanFull()
                    ->required(),
                MarkdownEditor::make('description')
                    ->fileAttachmentsDirectory('projects/attachments')
                    ->toolbarButtons([
                        ['bold', 'italic', 'strike', 'link'],
                        ['heading'],
                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                        ['table'],
                        ['table'],
                        ['undo', 'redo'],
                    ])->columnSpanFull(),

                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required(),
                DateTimePicker::make('due_at'),
            ]);
    }
}
