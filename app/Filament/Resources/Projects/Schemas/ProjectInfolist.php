<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Project;
use Faker\Core\Color;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Symfony\Component\Console\Helper\TableSeparator;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project')->schema([
                    TextEntry::make('title'),
                    TextEntry::make('description')
                        ->markdown()
                        ->placeholder('-')
                        ->columnSpanFull(),
                    TextEntry::make('owner.name')
                        ->label('Owner'),
                    TextEntry::make('due_at')
                        ->dateTime()
                        ->placeholder('-'),
                    TextEntry::make('created_at')
                        ->since()
                        ->placeholder('-'),
                    TextEntry::make('deleted_at')
                        ->dateTime()
                        ->visible(fn(Project $record): bool => $record->trashed()),
                ])->columnSpanFull()->columns(3),
                Section::make('Tasks')
                    ->schema([
                        RepeatableEntry::make('tasks')
                            ->schema([
                                TextEntry::make('title')
                                    ->label('Task Title')
                                    ->weight('bold'),
                                TextEntry::make('description')
                                    ->label('Description')
                                    ->markdown()
                                    ->placeholder('-')
                                    ->columnSpanFull(),
                                TextEntry::make('status.name')
                                    ->label('Status')
                                    ->badge()->hiddenLabel(),
                                TextEntry::make('due_at')
                                    ->label('Due Date')
                                    ->dateTime()
                                    ->placeholder('-'),
                                TextEntry::make('created_at')->since()->hiddenLabel()
                            ])->columns(3)
                    ])->columns(1)
                    ->visible(fn(Project $record): bool => $record->tasks()->exists()),

                Section::make('Attachments')
                    ->schema([
                        RepeatableEntry::make('attachments')->columns(2)
                            ->label('')
                            ->schema([
                                TextEntry::make('name')->badge()
                                    ->icon(Heroicon::ArrowDown)
                                    ->label('Download')
                                    ->size('xl')
                                    ->color('success')
                                    ->url(fn($record) => asset('storage/' . $record->path))
                                    ->openUrlInNewTab()
                                    ->weight('bold'),
                                TextEntry::make('size')
                                    ->label('Size')
                                    ->formatStateUsing(fn($state) => $state ? number_format($state / 1024, 2) . ' KB' : 'Unknown'),
                                TextEntry::make('user.name')
                                    ->label('Uploaded by')
                                    ->placeholder('-'),
                                TextEntry::make('created_at')
                                    ->label('Uploaded at')
                                    ->dateTime(),
                            ])
                            ->columns(4),
                    ])
                    ->visible(fn(Project $record): bool => $record->attachments()->exists()),

            ])->columns(2);
    }
}
