<?php

namespace App\Services;


class FinancialReportService
{
    public function getFinancialReport(): array
    {
        $monthlyRevenue = Subscription::where('status', SubscriptionStatus::ACTIVE)
        ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
        ->sum('plans.price');

        $monthlyExpenses = Expense::whereYear('date', Carbon::now()->year)
        ->whereMonth('date', Carbon::now()->month)
        ->sum('value');

        $monthlyNetProfit = $monthlyRevenue - $monthlyExpenses;

        $profitMargin = ($monthlyNetProfit / $monthlyRevenue) * 100;

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

    }
    
}