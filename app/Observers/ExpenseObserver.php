<?php

namespace App\Observers;

use App\Models\Expense;
use Illuminate\Support\Facades\Cache;

class ExpenseObserver
{
    /**
     * Handle the Expense "created" event.
     */
    public function created(Expense $expense): void
    {
        Cache::forget('expenses.paginated');
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
    }

    /**
     * Handle the Expense "updated" event.
     */
    public function updated(Expense $expense): void
    {
        Cache::forget('expenses.paginated');
        Cache::forget("expenses.{$expense->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
    }

    /**
     * Handle the Expense "deleted" event.
     */
    public function deleted(Expense $expense): void
    {
        Cache::forget('expenses.paginated');
        Cache::forget("expenses.{$expense->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
    }

    /**
     * Handle the Expense "restored" event.
     */
    public function restored(Expense $expense): void
    {
        //
    }

    /**
     * Handle the Expense "force deleted" event.
     */
    public function forceDeleted(Expense $expense): void
    {
        //
    }
}
