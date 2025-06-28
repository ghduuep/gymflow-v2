<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\DashboardController;

Route::apiResource('students', StudentController::class);
Route::apiResource('plans', PlanController::class);
Route::apiResource('tasks', TaskController::class);
Route::apiResource('expenses', ExpenseController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
