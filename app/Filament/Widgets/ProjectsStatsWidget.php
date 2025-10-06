<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use App\Models\TaskStatus;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectsStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        $totalProjects = Project::count();
        $completedStatus = TaskStatus::where('name', 'Finished')->first();

        $projectsWithTasks = Project::withCount([
            'tasks',
            'tasks as completed_tasks_count' => function ($query) use ($completedStatus) {
                if ($completedStatus) {
                    $query->where('status_id', $completedStatus->id);
                }
            }
        ])->get();

        $avgCompleted = $projectsWithTasks->avg(function ($project) {
            return $project->tasks_count > 0
                ? ($project->completed_tasks_count / $project->tasks_count) * 100
                : 0;
        });

        $avgIncomplete = 100 - $avgCompleted;

        return [
            Stat::make(__('app.widgets.total_projects'), $totalProjects)
                ->description(__('app.widgets.all_projects_count'))
                ->color('primary'),
            Stat::make(__('app.widgets.avg_completed'), number_format($avgCompleted, 1) . '%')
                ->description(__('app.widgets.average_completion_rate'))
                ->color('success'),
            Stat::make(__('app.widgets.avg_incomplete'), number_format($avgIncomplete, 1) . '%')
                ->description(__('app.widgets.average_incomplete_rate'))
                ->color('warning'),
        ];
    }
}
