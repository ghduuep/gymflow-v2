<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Http\Requests\StorePlanRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdatePlanRequest;
use Illuminate\Support\Facades\Cache;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $plans = Cache::remember('plans.paginated', now()->addMinutes(60), function() {
            return Plan::paginate();
        });

        return response()->json($plans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlanRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $plan = Plan::create($validatedData);

        return response()->json($plan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan): JsonResponse
    {
        $cachedPlan = Cache::remember("plan.{$plan->id}", now()->addMinutes(60), function() use ($plan) {
            return $plan;
        });
        return response()->json($cachedPlan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanRequest $request, Plan $plan): JsonResponse
    {
        $validatedData = $request -> validated();

        $plan -> update($validatedData);

        return response()->json($plan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->noContent();
    }
}
