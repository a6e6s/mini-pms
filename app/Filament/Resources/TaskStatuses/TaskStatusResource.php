<?php

namespace App\Filament\Resources\TaskStatuses;

use App\Filament\Resources\TaskStatuses\Pages\CreateTaskStatus;
use App\Filament\Resources\TaskStatuses\Pages\EditTaskStatus;
use App\Filament\Resources\TaskStatuses\Pages\ListTaskStatuses;
use App\Filament\Resources\TaskStatuses\Pages\ViewTaskStatus;
use App\Filament\Resources\TaskStatuses\Schemas\TaskStatusForm;
use App\Filament\Resources\TaskStatuses\Schemas\TaskStatusInfolist;
use App\Filament\Resources\TaskStatuses\Tables\TaskStatusesTable;
use App\Models\TaskStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TaskStatusResource extends Resource
{
    protected static ?string $model = TaskStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return __('app.resources.task_statuses');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.resources.task_statuses');
    }

    public static function form(Schema $schema): Schema
    {
        return TaskStatusForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TaskStatusInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaskStatusesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTaskStatuses::route('/'),
            'create' => CreateTaskStatus::route('/create'),
            'view' => ViewTaskStatus::route('/{record}'),
            'edit' => EditTaskStatus::route('/{record}/edit'),
        ];
    }
}
