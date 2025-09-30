<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
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
                    ->fileAttachmentsDirectory('attachments/projects')
                    ->toolbarButtons([
                        ['bold', 'italic', 'strike', 'link'],
                        ['heading'],
                        // ['color'],
                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                        ['table'],
                        ['undo', 'redo'],
                    ])->columnSpanFull(),

                Select::make('owner_id')
                    ->relationship('owner', 'name')
                    ->required(),
                DateTimePicker::make('due_at'),
                FileUpload::make('attachments')
                    ->label('Attachments')
                    ->multiple()
                    ->disk('public')
                    //make the file not thumbnail
                    ->imagePreviewHeight('50')
                    ->directory('attachments/projects')
                    ->fetchFileInformation(true)
                    ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain'])
                    ->maxSize(10240) // 10MB,
            ]);
    }
}
