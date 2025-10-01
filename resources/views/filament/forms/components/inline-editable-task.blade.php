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
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
        <div x-show="!editing.title" @click="toggleEdit('title')"
            class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            <span class="text-gray-900 dark:text-white" x-text="formData.title"></span>
        </div>
        <input x-show="editing.title" x-ref="title" type="text" x-model="formData.title" @blur="saveField('title')"
            @keydown.enter="saveField('title')"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
    </div>
    <div class="grid grid-cols-2 gap-4">

        {{-- Project --}}
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Project</label>
            <div x-show="!editing.project" @click="toggleEdit('project')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span class="text-gray-900 dark:text-white">{{ $task->project->title ?? '-' }}</span>
            </div>
            <select x-show="editing.project" x-ref="project" x-model="formData.project_id" @blur="saveField('project')"
                @change="saveField('project')"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                @foreach (\App\Models\Project::all() as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
            <div x-show="!editing.status" @click="toggleEdit('status')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span class="text-gray-900 dark:text-white">{{ $task->status->name ?? '-' }}</span>
            </div>
            <select x-show="editing.status" x-ref="status" x-model="formData.status_id" @blur="saveField('status')"
                @change="saveField('status')"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                @foreach (\App\Models\TaskStatus::all() as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- Description --}}
    <div class="space-y-1">
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
        <div x-show="!editing.description" @click="toggleEdit('description')"
            class="p-3 bg-gray-50 dark:bg-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 min-h-24 transition">
            <span class="text-gray-900 dark:text-white whitespace-pre-wrap"
                x-text="formData.description || 'Click to add description...'"></span>
        </div>
        <textarea x-show="editing.description" x-ref="description" x-model="formData.description"
            @blur="saveField('description')" rows="4"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500"></textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        {{-- Due Date --}}
        <div class="space-y-1">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
            <div x-show="!editing.due_at" @click="toggleEdit('due_at')"
                class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <span
                    class="text-gray-900 dark:text-white">{{ $task->due_at ? $task->due_at->format('M d, Y H:i') : 'Not set' }}</span>
            </div>
            <input x-show="editing.due_at" x-ref="due_at" type="datetime-local" x-model="formData.due_at"
                @blur="saveField('due_at')" @change="saveField('due_at')"
                class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
        </div>

        {{-- Time Estimated --}}
        <div class="space-y-1">
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
        </div>
    </div>

    {{-- Time Taken --}}
    <div class="space-y-1">
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Time Taken</label>
        <div x-show="!editing.time_taken" @click="toggleEdit('time_taken')"
            class="p-3 bg-gray-50 dark:bg-gray-900 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            <span class="text-gray-900 dark:text-white"
                x-text="formData.time_taken ? formData.time_taken + ' min' : 'Not set'"></span>
        </div>
        <input x-show="editing.time_taken" x-ref="time_taken" type="number" x-model="formData.time_taken"
            @blur="saveField('time_taken')" @keydown.enter="saveField('time_taken')" placeholder="Minutes"
            class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
    </div>

    {{-- Comments Section --}}
    <div class="space-y-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Comments</h3>
        @forelse($task->comments as $comment)
            <div class="border-l-2 border-primary-500 pl-3 py-2">
                <div class="font-semibold text-sm text-gray-900 dark:text-white">{{ $comment->user->name }}</div>
                <div class="text-gray-700 dark:text-gray-300 mt-1">{{ $comment->body }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $comment->created_at }}</div>
            </div>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400 italic">No comments yet.</p>
        @endforelse
    </div>
</div>
