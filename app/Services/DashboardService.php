<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Task;
use App\Models\Expense;
use App\Models\Subscription;
use App\Enums\SubscriptionStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class DashboardService
{
    public function getDashboardData(): array
    {
        return Cache::remember('dashboard_data', now()->addMinutes(60), function () {
        $activeStudents = Student::where('active', true)->count();
        $activeSubscription = Subscription::where('status', SubscriptionStatus::ACTIVE)->count();
        $monthlyRevenue = Subscription::where('status', SubscriptionStatus::ACTIVE)
        ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
        ->sum('plans.price');

        $monthlyExpenses = Expense::whereYear('date', Carbon::now()->year)
        ->whereMonth('date', Carbon::now()->month)
        ->sum('value');

        $monthlyNetProfit = $monthlyRevenue - $monthlyExpenses;

        $pendingTasks = Task::where('completed', false)
        ->orderBy('priority', 'desc')
        ->limit(5)
        ->get();

        return [
            'active_students' => $activeStudents,
            'active_subscriptions' => $activeSubscription,
            'monthly_revenue' => (float) $monthlyRevenue,
            'monthly_expenses' => (float) $monthlyExpenses,
            'monthly_net_profit' => (float) $monthlyNetProfit,
            'pendind_tasks' => $pendingTasks,
        ];
        });
}
}