<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FinancialReportService;
use Illuminate\Http\JsonResponse;

class FinancialReportController extends Controller
{
    public function __construct(private FinancialReportService $financialReportService)
    {}

    public function index(): JsonResponse
    {
        $reportData = $this->financialReportService->getFinancialReport();

        return response()->json($reportData);
    }
}
