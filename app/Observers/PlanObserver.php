<?php

namespace App\Observers;

use App\Models\Plan;
use Illuminate\Support\Facades\Cache;

class PlanObserver
{
    /**
     * Handle the Plan "created" event.
     */
    public function created(Plan $plan): void
    {
        Cache::forget('plans.paginated');
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Plan "updated" event.
     */
    public function updated(Plan $plan): void
    {
        Cache::forget('plans.paginated');
        Cache::forget("plans.{$plan->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Plan "deleted" event.
     */
    public function deleted(Plan $plan): void
    {
        Cache::forget('plans.paginated');
        Cache::forget("plans.{$plan->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Plan "restored" event.
     */
    public function restored(Plan $plan): void
    {
        //
    }

    /**
     * Handle the Plan "force deleted" event.
     */
    public function forceDeleted(Plan $plan): void
    {
        //
    }
}
