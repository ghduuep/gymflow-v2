<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Subscription;
use App\Enums\SubscriptionStatus;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

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

        if(count($data['students_id']) > $plan->max_students) {
            throw ValidationException::withMessages([
                'students_id' => 'O número de alunos excede o limite para este plano.'
            ]);
        }

        $startDate = isset($data['start_date']) ? Carbon::parse($data['start_date']) : Carbon::now();

        $endDate = $startDate->copy()->addMonths($plan->duration_months);

        $subscriptionData = array_merge($data, [
            'status' => SubscriptionStatus::PENDING_PAYMENT,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        $subscription = Subscription::create($subscriptionData);

        $subscription->students()->attach($data['students_id']);

        $subscription->load(['student', 'plan']);

        return $subscription;
    }

    public function updateSubscription(array $data, Subscription $subscription): Subscription{
        if (isset($data['student_ids'])) {
            $plan = $subscription->plan;
            if (count($data['student_ids']) > $plan->max_students) {
                throw ValidationException::withMessages([
                    'student_ids' => 'O número de alunos excede o limite para este plano.'
                ]);
            }

            // Sincroniza os alunos na tabela pivot
            $subscription->students()->sync($data['student_ids']);
        }

        // Atualiza os outros campos da assinatura
        $subscription->update(Arr::except($data, ['student_ids']));

        $subscription->load(['students', 'plan']);

        return $subscription;
    }
}