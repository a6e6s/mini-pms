<x-filament-panels::page>
    <div class="w-full" x-data="{ draggedTask: null, draggedFrom: null }">
        {{-- Filters Section --}}
        <div class="mb-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
            <div class="flex justify-between items-center gap-4 flex-wrap">
                {{-- View Tabs --}}
                <div class="flex gap-1 bg-gray-100 dark:bg-gray-900 p-1 rounded-lg">
                    <button wire:click="setActiveTab('all')"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $activeTab === 'all' ? 'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        {{ __('app.kanban.all_tasks') }}
                    </button>
                    <button wire:click="setActiveTab('my-tasks')"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $activeTab === 'my-tasks' ? 'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        {{ __('app.kanban.my_tasks') }}
                    </button>
                    <button wire:click="setActiveTab('my-projects')"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $activeTab === 'my-projects' ? 'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200' }}">
                        {{ __('app.kanban.my_project_tasks') }}
                    </button>
                </div>

                {{-- Filters --}}
                <div class="flex gap-3">
                    <select wire:model.live="selectedProject"
                        class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-primary-500 focus:ring-primary-500">
                        <option value="">{{ __('app.kanban.all_projects') }}</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="selectedUser"
                        class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-primary-500 focus:ring-primary-500">
                        <option value="">{{ __('app.kanban.all_users') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="flex gap-4 overflow-x-auto pb-4">
            @foreach ($statuses as $status)
                <div class="flex flex-col flex-shrink-0 w-80 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700"
                    :class="{
                        'ring-1': true,
                        'ring-primary-300': '{{ $status->color }}'
                        === 'primary',
                        'ring-secondary-300': '{{ $status->color }}'
                        === 'secondary',
                        'ring-success-300': '{{ $status->color }}'
                        === 'success',
                        'ring-warning-300': '{{ $status->color }}'
                        === 'warning',
                        'ring-danger-300': '{{ $status->color }}'
                        === 'danger',
                        'ring-info-300': '{{ $status->color }}'
                        === 'info',
                        'ring-gray-300': '{{ $status->color }}'
                        === 'light',
                        'ring-gray-500': '{{ $status->color }}'
                        === 'dark'
                    }"
                    @dragover.prevent="$el.classList.add('ring-2', 'ring-primary-400', 'bg-primary-50', 'dark:bg-primary-900/20')"
                    @dragleave="$el.classList.remove('ring-2', 'ring-primary-400', 'bg-primary-50', 'dark:bg-primary-900/20')"
                    @drop.prevent="
                        $el.classList.remove('ring-2', 'ring-primary-400', 'bg-primary-50', 'dark:bg-primary-900/20');
                        if (draggedTask && draggedFrom !== {{ $status->id }}) {
                            $wire.updateTaskStatus(draggedTask, {{ $status->id }});
                        }
                    ">
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold uppercase tracking-wide"
                            :class="{
                                'text-primary-600 dark:text-primary-400': '{{ $status->color }}'
                                === 'primary',
                                'text-secondary-600 dark:text-secondary-400': '{{ $status->color }}'
                                === 'secondary',
                                'text-success-600 dark:text-success-400': '{{ $status->color }}'
                                === 'success',
                                'text-warning-600 dark:text-warning-400': '{{ $status->color }}'
                                === 'warning',
                                'text-danger-600 dark:text-danger-400': '{{ $status->color }}'
                                === 'danger',
                                'text-info-600 dark:text-info-400': '{{ $status->color }}'
                                === 'info',
                                'text-gray-600 dark:text-gray-400': '{{ $status->color }}'
                                === 'light',
                                'text-gray-900 dark:text-gray-100': '{{ $status->color }}'
                                === 'dark'
                            }">
                                {{ $status->name }}
                            </h3>
                            <span class="text-xs font-medium px-2 py-1 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                {{ $status->tasks->count() }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col flex-1 gap-2 p-3 overflow-y-auto" style="min-height: 400px; max-height: 70vh;">
                        @forelse($status->tasks as $task)
                            <div draggable="true"
                                @dragstart="draggedTask = {{ $task->id }}; draggedFrom = {{ $status->id }}; $el.classList.add('opacity-50');"
                                @dragend="draggedTask = null; draggedFrom = null; $el.classList.remove('opacity-50');"
                                @click="$wire.mountAction('viewTask', { task: {{ $task->id }} })"
                                class="group p-3 bg-white dark:bg-gray-800 rounded-md border border-gray-200 dark:border-gray-700 cursor-pointer hover:shadow-lg hover:border-primary-300 dark:hover:border-primary-600 transition-all duration-200">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400">
                                    {{ $task->title }}
                                </h4>

                                @if ($task->description)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 line-clamp-2">
                                        {{ $task->description }}
                                    </p>
                                @endif

                                <div class="space-y-2">
                                    @if ($task->project)
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs px-2 py-0.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded font-medium">
                                                {{ $task->project->title }}
                                            </span>
                                        </div>
                                    @endif
                                    @if ($task->time_estimated || $task->time_taken || $task->due_at)
                                        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 flex-wrap">
                                            @if ($task->due_at)
                                                <span class="flex items-center gap-1 px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $task->due_at->format('M d') }}
                                                </span>
                                            @endif
                                            @if ($task->time_estimated)
                                                <span class="flex items-center gap-1 px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $task->time_estimated }}m
                                                </span>
                                            @endif
                                            @if ($task->time_taken)
                                                <span class="flex items-center gap-1 px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $task->time_taken }}m
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($task->users->count() > 0)
                                        <div class="flex items-center gap-1 mt-2">
                                            @foreach ($task->users->take(3) as $assignedUser)
                                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-xs font-medium" title="{{ $assignedUser->name }}">
                                                    {{ strtoupper(substr($assignedUser->name, 0, 1)) }}
                                                </div>
                                            @endforeach
                                            @if ($task->users->count() > 3)
                                                <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-600 dark:text-gray-400 text-xs font-medium">
                                                    +{{ $task->users->count() - 3 }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center h-32 text-gray-400 dark:text-gray-500">
                                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="text-sm font-medium">{{ __('app.kanban.no_tasks') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <x-filament-actions::modals />
</x-filament-panels::page>
