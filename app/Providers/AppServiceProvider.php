<?php

namespace App\Providers;

use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Task;
use App\Models\TaskUser;
use App\Observers\AttachmentObserver;
use App\Observers\CommentObserver;
use App\Observers\TaskObserver;
use App\Observers\TaskUserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        
        Task::observe(TaskObserver::class);
        Comment::observe(CommentObserver::class);
        TaskUser::observe(TaskUserObserver::class);
        Attachment::observe(AttachmentObserver::class);
    }
}
