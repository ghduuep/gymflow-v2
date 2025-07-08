<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\Task;
use Illuminate\Support\Facades\Cache;

class GeneralReportService
{
    public static function getGeneralReport(): array
    {
        return Cache::remember('general_report', now()->addMinutes(60), function () {
        $allStudents = Student::all()->count();
        $allSubscriptions = Subscription::all()->count();
        $allPlans = Plan::all()->count();
        $allTasks = Task::all()->count();

        $subscriptionByStatus = Subscription::groupBy('status')->count();
        $tasksByCompleted = Task::groupBy('completed')->count();

        $mostPopularPlans = Plan::withCount('subscriptions')
        ->orderBy('subscriptions_count', 'desc')
        ->take(3)
        ->get();

        return [
            'all_students' => $allStudents,
            'all_subscriptions' => $allSubscriptions,
            'all_plans' => $allPlans,
            'all_tasks' => $allTasks,
            'subscription_by_status' => $subscriptionByStatus,
            'tasks_by_completed' => $tasksByCompleted,
            'most_popular_plans' => $mostPopularPlans,
        ];
    });
}
}
