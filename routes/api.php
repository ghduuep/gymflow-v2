<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\FinancialReportController;
use App\Http\Controllers\Api\GeneralReportController;

Route::apiResource('students', StudentController::class);
Route::apiResource('plans', PlanController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('expenses', ExpenseController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/financial', [FinancialReportController::class, 'index']);
    Route::get('/general', [GeneralReportController::class, 'index']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
