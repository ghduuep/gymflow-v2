<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Expense;
use App\Enums\SubscriptionStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class FinancialReportService
{
    public static function getFinancialReport(): array
    {
        return Cache::remember('financial_report', now()->addMinutes(60), function () {
        $monthlyRevenue = Subscription::where('status', SubscriptionStatus::ACTIVE)
        ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
        ->sum('plans.price');

        $monthlyExpenses = Expense::whereYear('date', Carbon::now()->year)
        ->whereMonth('date', Carbon::now()->month)
        ->sum('value');

        $monthlyNetProfit = $monthlyRevenue - $monthlyExpenses;

        $profitMargin = (($monthlyNetProfit / $monthlyRevenue) * 100) ? ($monthlyRevenue != 0) : 0;

        $expensesByCategory = Expense::groupby('category')->sum('value');

        $revenueByPlan = Plan::query()
        ->join('subscriptions', 'plans.id', '=', 'subscriptions.plan_id')
        ->select(
            'plans.name',
            'plans.price',
            DB::raw('COUNT(subscriptions.id) as total_subscriptions'),
            DB::raw('COUNT(subscriptions.id) * plans.price as total_revenue')
        )

        ->groupBy('plans.id', 'plans.name', 'plans.price')
        ->orderByDesc('total_revenue')

        ->get();


        return [
            'monthly_revenue' => (float) $monthlyRevenue,
            'monthly_expenses' => (float) $monthlyExpenses,
            'monthly_net_profit' => (float) $monthlyNetProfit,
            'profit_margin' => (float) $profitMargin,
            'expenses_by_category' => $expensesByCategory,
            'revenue_by_plan' => $revenueByPlan,
        ];
    });
}
}