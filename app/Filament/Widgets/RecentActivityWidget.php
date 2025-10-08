<?php

namespace App\Filament\Widgets;

use App\Models\Activity;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentActivityWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Activity::query()
                    ->with(['user', 'loggable'])
                    ->latest()
                    ->limit(6)
            )
            ->columns([
                TextColumn::make('human_readable')
                    ->label(__('app.activity.activity'))
                    ->wrap()
                    ->searchable(false)
                    ->sortable(false),
                TextColumn::make('created_at')
                    ->label(__('app.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->paginated(false);
    }

    public function getTableHeading(): ?string
    {
        return __('app.activity.recent_activity');
    }
}
