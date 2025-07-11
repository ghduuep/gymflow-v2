<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        Cache::forget('tasks.paginated');
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        Cache::forget('tasks.paginated');
        Cache::forget("tasks.{$task->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        Cache::forget('tasks.paginated');
        Cache::forget("tasks.{$task->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
