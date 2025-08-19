<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Models\Tag;
use App\Policies\TaskPolicy;
use App\Policies\UserPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TagPolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Project::class, ProjectPolicy::class);
        Gate::policy(Task::class, TaskPolicy::class);
        Gate::policy(Tag::class, TagPolicy::class);
    }
}
