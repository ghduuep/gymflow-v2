<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Subscription;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Enums\SubscriptionStatus;
use Carbon\Carbon;
use App\Models\Plan;


class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $subscriptions = Subscription::with(['student', 'plan'])->paginate();

        return response()->json($subscriptions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request): JsonResponse
    {
        $subscription = $this->$subscriptionService->createSubscription($request->validated());
        return response()->json($subscription, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription): JsonResponse
    {
        return response()->json($subscription)->load(['student', 'plan']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription): JsonResponse
    {
        $validatedData = $request->validated();
        $subscription->update($validatedData);

        $subscription->load(['student', 'plan']);

        return response()->json($subscription);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription): JsonResponse
    {
        $subscription->delete();
        return response()->noContent();
    }
}
