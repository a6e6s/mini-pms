<div x-data="{
    editing: {},
    hasChanges: false,
    formData: {
        title: @js($task->title),
        project_id: @js($task->project_id),
        status_id: @js($task->status_id),
        description: @js($task->description),
        due_at: @js($task->due_at?->format('Y-m-d\TH:i')),
        time_estimated: @js($task->time_estimated),
        time_taken: @js($task->time_taken)
    },
    toggleEdit(field) {
        this.editing[field] = !this.editing[field];
        if (this.editing[field]) {
            this.$nextTick(() => this.$refs[field]?.focus());
        }
    },
    saveField(field) {
        this.editing[field] = false;
        $wire.call('updateTask', {{ $task->id }}, field, this.formData[field]);
    }
}" class="space-y-4">

    {{-- Title --}}
    <div class="space-y-1">
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">@lang('app.fields.title')</label>
        <div x-show="!editing.title" @click="toggleEdit('title')"
            class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            <span class="text-gray-900 dark:text-white" x-text="formData.title"></span>
        </div>
        <input x-show="editing.title" x-ref="title" type="text" x-model="formData.title" @blur="saveField('title')"
            @keydown.enter="saveField('title')"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 p-3">
    </div>
    <div class="grid grid-cols-2 gap-4">

        {{-- Project --}}
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">@lang('app.fields.project')</label>
            <div x-show="!editing.project" @click="toggleEdit('project')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span class="text-gray-900 dark:text-white">{{ $task->project->title ?? '-' }}</span>
            </div>
            <select x-show="editing.project" x-ref="project" x-model="formData.project_id" @blur="saveField('project')"
                @change="saveField('project')"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 p-3">
                @foreach (\App\Models\Project::all() as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">@lang('app.fields.status')</label>
            <div x-show="!editing.status" @click="toggleEdit('status')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span class="text-gray-900 dark:text-white">{{ $task->status->name ?? '-' }}</span>
            </div>
            <select x-show="editing.status" x-ref="status" x-model="formData.status_id" @blur="saveField('status')"
                @change="saveField('status')"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 p-3">
                @foreach (\App\Models\TaskStatus::all() as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- Description --}}
    <div class="space-y-1">
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">@lang('app.fields.description')</label>
        <div x-show="!editing.description" @click="toggleEdit('description')"
            class="p-3 dark:bg-gray-700 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 min-h-24 transition">
            <span class="text-gray-900 dark:text-white whitespace-pre-wrapx"
                x-text="formData.description || '@lang('app.kanban.click_to_add_description')'"></span>
        </div>
        <textarea x-show="editing.description" x-ref="description" x-model="formData.description"
            @blur="saveField('description')" rows="4"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 p-3"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        {{-- Due Date --}}
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">@lang('app.fields.due_date')</label>
            <div x-show="!editing.due_at" @click="toggleEdit('due_at')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span
                    class="text-gray-900 dark:text-white">{{ $task->due_at ? $task->due_at->format('M d, Y H:i') : __('app.kanban.not_set') }}</span>
            </div>
            <input x-show="editing.due_at" x-ref="due_at" type="datetime-local" x-model="formData.due_at"
                @blur="saveField('due_at')" @change="saveField('due_at')"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 p-3">
        </div>

        {{-- Time Estimated --}}
        {{-- <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Estimated Time</label>
            <div x-show="!editing.time_estimated" @click="toggleEdit('time_estimated')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span class="text-gray-900 dark:text-white"
                    x-text="formData.time_estimated ? formData.time_estimated + ' min' : 'Not set'"></span>
            </div>
            <input x-show="editing.time_estimated" x-ref="time_estimated" type="number"
                x-model="formData.time_estimated" @blur="saveField('time_estimated')"
                @keydown.enter="saveField('time_estimated')" placeholder="Minutes"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
        </div> --}}
        {{-- Time Taken --}}
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">@lang('app.fields.time_taken')</label>
            <div x-show="!editing.time_taken" @click="toggleEdit('time_taken')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span class="text-gray-900 dark:text-white"
                    x-text="formData.time_taken ? formData.time_taken + ' min' : 'Not set'"></span>
            </div>
            <input x-show="editing.time_taken" x-ref="time_taken" type="number" x-model="formData.time_taken"
                @blur="saveField('time_taken')" @keydown.enter="saveField('time_taken')" placeholder="Minutes"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 p-3">
        </div>

    </div>

    {{-- Assigned user --}}
    <div class="space-y-1 mb-3">
        <label class="text-sm font-medium badge text-gray-700 dark:text-gray-300">@lang('app.fields.assigned_user')</label>
        @foreach ($task->users as $assignedUser)
            <span class="px-2 py-1 bg-success-100 dark:bg-success-900 text-success-800 dark:text-success-200 rounded">
                {{ $assignedUser->name ?? '-' }}</span>
        @endforeach
    </div>

    {{-- Tabbed Interface for Comments, Attachments and Activity --}}
    <div class="pt-4 border-t border-gray-200 dark:border-gray-700" x-data="{ activeTab: 'comments' }">
        {{-- Tab Headers --}}
        <div class="flex gap-1 bg-gray-100 dark:bg-gray-900 p-1 rounded-lg mb-4">
            <span @click.stop="activeTab = 'comments'"
                :class="activeTab === 'comments' ? 'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200'"
                class="flex-1 px-4 py-2 rounded-md text-sm font-medium transition-all">
                @lang('app.kanban.comments') ({{ $task->comments->count() }})
            </span>
            <span @click.stop="activeTab = 'attachments'"
                :class="activeTab === 'attachments' ? 'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200'"
                class="flex-1 px-4 py-2 rounded-md text-sm font-medium transition-all">
                @lang('app.fields.attachments') ({{ $task->attachments->count() }})
            </span>
            <span @click.stop="activeTab = 'activity'"
                :class="activeTab === 'activity' ? 'bg-white dark:bg-gray-700 text-primary-600 dark:text-primary-400 shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200'"
                class="flex-1 px-4 py-2 rounded-md text-sm font-medium transition-all">
                @lang('app.activity.activity_log')
            </span>
        </div>

        {{-- Comments Tab Content --}}
        <div x-show="activeTab === 'comments'" class="space-y-3">
            @forelse($task->comments as $comment)
                <div class="border-l-2 border-primary-500 pl-3 py-2">
                    <div class="font-semibold text-sm text-gray-900 dark:text-white">{{ $comment->user->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 mt-1">{{ $comment->body }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</div>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 italic">@lang('app.kanban.no_comments_yet')</p>
            @endforelse
        </div>

        {{-- Attachments Tab Content --}}
        <div x-show="activeTab === 'attachments'" class="space-y-3">
            @forelse($task->attachments as $attachment)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                    <div class="flex items-center gap-3">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $attachment->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($attachment->size / 1024, 2) }} KB • {{ \Carbon\Carbon::parse($attachment->created_at)->diffForHumans() }}</p>
                        </div>
                    </div>
                    <a href="{{ Storage::url($attachment->path) }}" download class="text-primary-600 hover:text-primary-700 dark:text-primary-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </a>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 italic">@lang('app.kanban.no_attachments_yet')</p>
            @endforelse
        </div>

        {{-- Activity Log Tab Content --}}
        <div x-show="activeTab === 'activity'" class="space-y-3">
            @forelse($task->activities()->with('user')->limit(10)->get() as $activity)
                <div class="flex items-start gap-3 py-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white text-xs font-medium flex-shrink-0">
                        {{ strtoupper(substr($activity->user?->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $activity->human_readable }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 italic">@lang('app.activity.no_activity_yet')</p>
            @endforelse
        </div>
    </div>
</div>
