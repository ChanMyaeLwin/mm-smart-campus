<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $students = Student::with('user')->paginate(15);
        
        return response()->json([
            'data' => $students->items(),
            'meta' => [
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
                'per_page' => $students->perPage(),
                'total' => $students->total(),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed for API
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());
        $student->load('user');

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student): JsonResponse
    {
        $student->load('user');
        
        return response()->json([
            'data' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        // Not needed for API
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $student->update($request->validated());
        $student->load('user');

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}