<?php

namespace App\Filament\Resources\Attachments\Schemas;

use App\Models\Attachment;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AttachmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('path'),
                TextEntry::make('model'),
                TextEntry::make('size')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('user.name')
                    ->label('User')
                    ->placeholder('-'),
                TextEntry::make('attachable_id')
                    ->numeric(),
                TextEntry::make('attachable_type'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Attachment $record): bool => $record->trashed()),
            ]);
    }
}
