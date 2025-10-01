<div x-data="{
    draggedTask: null,
    draggedFrom: null
}">
    <div class="flex gap-6 overflow-x-auto pb-4">
        @foreach ($statuses as $status)
            <div class="flex flex-col flex-shrink-0 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-lg"
                x-on:dragover.prevent="$el.classList.add('bg-gray-100', 'dark:bg-gray-700')"
                x-on:dragleave="$el.classList.remove('bg-gray-100', 'dark:bg-gray-700')"
                x-on:drop.prevent="
                    $el.classList.remove('bg-gray-100', 'dark:bg-gray-700');
                    if (draggedTask && draggedFrom !== {{ $status->id }}) {
                        $wire.updateTaskStatus(draggedTask, {{ $status->id }});
                    }
                ">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $status->name }}
                    </h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $status->tasks->count() }} {{ Str::plural('task', $status->tasks->count()) }}
                    </span>
                </div>

                <div class="flex flex-col flex-1 gap-3 p-4 overflow-y-auto" style="min-height: 400px; max-height: 70vh;">
                    @forelse($status->tasks as $task)
                        <div draggable="true"
                            x-on:dragstart="
                                draggedTask = {{ $task->id }};
                                draggedFrom = {{ $status->id }};
                                $el.classList.add('opacity-50');
                            "
                            x-on:dragend="
                                draggedTask = null;
                                draggedFrom = null;
                                $el.classList.remove('opacity-50');
                            "
                            class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg shadow cursor-move hover:shadow-md transition-shadow">
                            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $task->title }}
                            </h4>

                            @if ($task->description)
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3 line-clamp-2">
                                    {{ $task->description }}
                                </p>
                            @endif

                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400">
                                    @if ($task->project)
                                        <span
                                            class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded">
                                            {{ $task->project->title }}
                                        </span>
                                    @endif

                                    @if ($task->due_at)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $task->due_at->format('M d') }}
                                        </span>
                                    @endif
                                </div>

                                @if ($task->time_estimated || $task->time_taken)
                                    <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400">
                                        @if ($task->time_estimated)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Est: {{ $task->time_estimated }}m
                                            </span>
                                        @endif
                                        @if ($task->time_taken)
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Actual: {{ $task->time_taken }}m
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center h-32 text-gray-400 dark:text-gray-600">
                            <p class="text-sm">No tasks</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</div>
