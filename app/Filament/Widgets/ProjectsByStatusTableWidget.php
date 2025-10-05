<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\TaskStatus;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProjectsByStatusTableWidget extends BaseWidget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()
                    ->withCount('tasks')
                    ->with(['tasks.status'])
            )
            ->columns([
                TextColumn::make('title')
                    ->label(__('app.fields.project'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('owner.name')
                    ->label(__('app.fields.owner'))
                    ->sortable(),
                ...TaskStatus::all()->map(function ($status) {
                    return TextColumn::make('status_' . $status->id)
                        ->label($status->name)
                        ->getStateUsing(function (Project $record) use ($status) {
                            return $record->tasks->where('status_id', $status->id)->count();
                        })
                        ->badge()
                        ->color($status->color->value);
                })->toArray(),
                TextColumn::make('tasks_count')
                    ->label(__('app.widgets.total_tasks'))
                    ->sortable(),
            ])
            ->defaultSort('title');
    }

    public function getTableHeading(): ?string
    {
        return __('app.widgets.projects_by_status');
    }
}
