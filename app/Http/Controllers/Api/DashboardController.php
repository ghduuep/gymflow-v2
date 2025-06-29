<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;


class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboardService)
    {}


    public function index(): JsonResponse
    {
        $dashboardData = $this->dashboardService->getDashboardData();

        return response()->json($dashboardData);
    }
}
