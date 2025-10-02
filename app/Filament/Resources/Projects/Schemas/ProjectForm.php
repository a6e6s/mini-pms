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
                TextInput::make('title')
                    ->label(__('app.fields.title'))
                    ->columnSpanFull()
                    ->required(),
                MarkdownEditor::make('description')
                    ->label(__('app.fields.description'))
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
                    ->label(__('app.fields.owner'))
                    ->relationship('owner', 'name')
                    ->required(),
                DateTimePicker::make('due_at')
                    ->label(__('app.fields.due_at')),
                FileUpload::make('attachments')
                    ->label(__('app.fields.attachments'))
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
