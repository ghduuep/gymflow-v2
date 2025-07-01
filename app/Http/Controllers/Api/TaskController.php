<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UpdateTaskRequest;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tasks = Cache::remember('tasks.paginated', now()->addMinutes(60), function() {
            return Task::paginate();
        });

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): JsonResponse
    {
        $validateData = $request->validated();

        $task = Task::create($validateData);

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): JsonResponse
    {
        $cachedTask = Cache::remember("task.{$task->id}", now()->addMinutes(60), function() use ($task) {
            return $task;
        });
        return response()->json($cachedTask);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}
