<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use App\Services\StudentService;

class StudentController extends Controller
{

    public function __construct(private StudentService $studentService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $students = Cache::remember('students_with_address.paginated', now()->addMinutes(60), function() {
            return Student::with('address')->paginate();
        });

        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = $this->studentService->createStudent($request->validated());

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): JsonResponse
    {
        $cachedStudent = Cache::remember("student_with_address.{$student->id}", now()->addMinutes(60), function() use ($student) {
            return $student->load('address');
        });
        return response()->json($cachedStudent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $updatedStudent = $this->studentService->updateStudent($request->validated(), $student);
        return response()->json($updatedStudent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->noContent();
    }
}
