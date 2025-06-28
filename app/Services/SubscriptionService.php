<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Subscription;
use App\Enums\SubscriptionStatus;
use Carbon\Carbon;

class SubscriptionService
{
    /**
     *
     *
     * @param array $data Os dados validados do request.
     * @return Subscription
     */
    public function createSubscription(array $data): Subscription
    {
        $plan = Plan::findOrFail($data['plan_id']);

        $startDate = isset($data['start_date']) ? Carbon::parse($data['start_date']) : Carbon::now();

        $endDate = $startDate->copy()->addMonths($plan->duration_months);

        $subscriptionData = array_merge($data, [
            'status' => SubscriptionStatus::PENDIND_PAYMENT,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $subscription = Subscription::create($subscriptionData);

        $subscription->load(['student', 'plan']);

        return $subscription;
    }
}