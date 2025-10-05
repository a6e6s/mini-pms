<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\TaskStatus;
use Filament\Widgets\ChartWidget;

class ProjectProgressWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    public function getHeading(): ?string
    {
        return __('app.widgets.projects_completion_progress');
    }

    public function getMaxHeight(): ?string
    {
        return '350px';
    }
    protected function getData(): array
    {
        $completedStatus = TaskStatus::where('name', 'Finished')->first();

        $projects = Project::withCount([
            'tasks',
            'tasks as completed_tasks_count' => function ($query) use ($completedStatus) {
                if ($completedStatus) {
                    $query->where('status_id', $completedStatus->id);
                }
            }
        ])->get();

        return [
            'datasets' => [
                [
                    'label' => __('app.widgets.completion_percentage'),
                    'data' => $projects->map(function ($project) {
                        return $project->tasks_count > 0
                            ? round(($project->completed_tasks_count / $project->tasks_count) * 100, 1)
                            : 0;
                    })->toArray(),
                    'backgroundColor' => '#2299dd',
                    'borderColor' => '#2299dd',
                    'borderWidth' => 1,
                    'hoverBackgroundColor' => '#1e88c7',
                    'hoverBorderColor' => '#1e88c7',
                ],
            ],
            'labels' => $projects->pluck('title')->toArray(),
            'height' => 500,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
