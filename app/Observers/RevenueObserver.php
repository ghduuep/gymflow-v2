<?php

namespace App\Observers;

use App\Models\Revenue;
use Illuminate\Support\Facades\Cache;


class RevenueObserver
{
    /**
     * Handle the Revenue "created" event.
     */
    public function created(Revenue $revenue): void
    {
        Cache::forget('revenues.paginated');
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
    }

    /**
     * Handle the Revenue "updated" event.
     */
    public function updated(Revenue $revenue): void
    {
        Cache::forget('revenues.paginated');
        Cache::forget("revenues.{$revenue->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
    }

    /**
     * Handle the Revenue "deleted" event.
     */
    public function deleted(Revenue $revenue): void
    {
        Cache::forget('revenues.paginated');
        Cache::forget("revenues.{$revenue->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
    }

    /**
     * Handle the Revenue "restored" event.
     */
    public function restored(Revenue $revenue): void
    {
        //
    }

    /**
     * Handle the Revenue "force deleted" event.
     */
    public function forceDeleted(Revenue $revenue): void
    {
        //
    }
}
