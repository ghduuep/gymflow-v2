<?php

namespace App\Observers;

use App\Models\Student;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        Cache::forget('students.paginated');
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        Cache::forget('students_paginated');
        Cache::forget("students.{$student->id}");
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        Cache::forget('students_paginated');
        Cache::forget("students.{$student->id}");
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        //
    }
}
