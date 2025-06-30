<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\GeneralReportService;

class GeneralReportController extends Controller
{
    public function __construct(private GeneralReportService $generalReportService)
    {}

    public function index(): JsonResponse
    {
        $reportData = $this->generalReportService->getGeneralReport();

        return response()->json($reportData);
    }
    
}