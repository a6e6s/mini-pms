<?php

namespace App\Filament\Widgets;

use App\Models\TaskStatus;
use Filament\Widgets\ChartWidget;

class TaskStatusesChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    public function getHeading(): ?string
    {
        return __('app.widgets.task_statuses_distribution');
    }

    public function getMaxHeight(): ?string
    {
        return '350px';
    }

    protected function getData(): array
    {
        $statuses = TaskStatus::withCount('tasks')->get();

        return [
            'datasets' => [
                [
                    'label' => __('app.widgets.tasks_count'),
                    'data' => $statuses->pluck('tasks_count')->toArray(),
                    'backgroundColor' => $statuses->map(fn($status) => $this->getColorForStatus($status->color->value))->toArray(),
                ],
            ],
            'labels' => $statuses->pluck('name')->map(fn ($name) => __($name))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    private function getColorForStatus(string $color): string
    {
        return match($color) {
            'primary' => 'rgb(59, 130, 246)',
            'success' => 'rgb(34, 197, 94)',
            'warning' => 'rgb(251, 146, 60)',
            'danger' => 'rgb(239, 68, 68)',
            'info' => 'rgb(14, 165, 233)',
            'secondary' => 'rgb(107, 114, 128)',
            default => 'rgb(156, 163, 175)',
        };
    }
}
