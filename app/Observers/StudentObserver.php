<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Facades\Cache;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        Cache::forget('students_with_address.paginated');
        Cache::forget('general_report');
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        Cache::forget('students_with_address.paginated');
        Cache::forget("students_with_address.{$student->id}");
        Cache::forget('general_report');
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        Cache::forget('students_with_address.paginated');
        Cache::forget("students_with_address.{$student->id}");
        Cache::forget('general_report');
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
