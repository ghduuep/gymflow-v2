<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRevenueRequest;
use App\Http\Requests\UpdateRevenueRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Revenue;
use Illuminate\Support\Facades\Cache;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $revenues = Cache::remember('revenues.paginated', now()->addMinutes(60), function() {
            return Revenue::paginate();
        });

        return response()->json($revenues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRevenueRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $revenue = Revenue::create($validatedData);

        return response()->json($revenue, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Revenue $revenue): JsonResponse
    {
        $cachedRevenue = Cache::remember("revenue.{$revenue->id}", now()->addMinutes(60), function() use ($revenue) {
            return $revenue;
        });
        return response()->json($cachedRevenue);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRevenueRequest $request, Revenue $revenue): JsonResponse
    {
        $validatedData = $request->validated();
        $revenue->update($validatedData);

        return response()->json($revenue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Revenue $revenue)
    {
        $revenue->delete();
        return response()->noContent();
    }
}
