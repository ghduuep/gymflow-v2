<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Plan;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\Task;
use App\Models\Expense;
use App\Observers\PlanObserver;
use App\Observers\StudentObserver;
use App\Observers\SubscriptionObserver;
use App\Observers\TaskObserver;
use App\Observers\ExpenseObserver;


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
        Plan::observe(PlanObserver::class);
        Student::observe(StudentObserver::class);
        Subscription::observe(SubscriptionObserver::class);
        Task::observe(TaskObserver::class);
        Expense::observe(ExpenseObserver::class);
    }
}
