<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        Cache::forget('tasks.paginated');
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        Cache::forget('tasks_paginated');
        Cache::forget("tasks.{$task->id}");
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        Cache::forget('tasks_paginated');
        Cache::forget("tasks.{$task->id}");
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
