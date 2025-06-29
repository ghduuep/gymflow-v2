<?php

namespace App\Services;

use App\Enums\SubscriptionStatus;
use App\Models\Expense;
use App\Models\Plan;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Support\Carbon;

class GeneralReportService
{
    public function getGeneralReport(): array
    {
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
    }
}
