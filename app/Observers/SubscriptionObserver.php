<?php

namespace App\Observers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Cache;

class SubscriptionObserver
{
    /**
     * Handle the Subscription "created" event.
     */
    public function created(Subscription $subscription): void
    {
        Cache::forget('subscriptions.paginated');
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Subscription "updated" event.
     */
    public function updated(Subscription $subscription): void
    {
        Cache::forget('subscriptions.paginated');
        Cache::forget("subscriptions.{$subscription->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Subscription "deleted" event.
     */
    public function deleted(Subscription $subscription): void
    {
        Cache::forget('subscriptions.paginated');
        Cache::forget("subscriptions.{$subscription->id}");
        Cache::forget('financial_report');
        Cache::forget('dashboard_data');
        Cache::forget('general_report');
    }

    /**
     * Handle the Subscription "restored" event.
     */
    public function restored(Subscription $subscription): void
    {
        //
    }

    /**
     * Handle the Subscription "force deleted" event.
     */
    public function forceDeleted(Subscription $subscription): void
    {
        //
    }
}
