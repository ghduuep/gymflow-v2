<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Task;
use App\Models\Expense;
use App\Models\Subscription;
use App\Enums\SubscriptionStatus;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService
{
    public function getDashboardData(): array
    {
        $activeStudents = Student::where('active', true)->count();
        $activeSubscription = Subscription::where('status', SubscriptionStatus::ACTIVE)->count();
        $monthlyRevenue = Subscription::where('status', SubscriptionStatus::ACTIVE)
        ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
        ->sum('plans.price');

        $monthlyExpenses = Expense::whereYear('date', Carbon::now()->year)
        ->whereMonth('date', Carbon::now()->month)
        ->sum('value');

        $monthlyNetProfit = $monthlyRevenue - $monthlyExpenses;

        return [
            'active_students' => $activeStudents,
            'active_subscriptions' => $activeSubscription,
            'monthly_revenue' => (float) $monthlyRevenue,
            'monthly_expenses' => (float) $monthlyExpenses,
            'monthly_net_profit' => (float) $monthlyNetProfit
        ];
    }
}