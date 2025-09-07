<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\StaffController;
use App\Http\Controllers\Api\V1\TeacherController;
use App\Http\Controllers\Api\V1\GuardianController;
use App\Http\Controllers\Api\V1\SchoolClassController;
use App\Http\Controllers\Api\V1\SubjectController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\ExamController;
use App\Http\Controllers\Api\V1\LeaveRequestController;
use App\Http\Controllers\Api\V1\FinanceController;
use App\Http\Controllers\Api\V1\ScheduleController;
use App\Http\Controllers\Api\V1\AnnouncementController;
use App\Http\Controllers\Api\V1\AttendanceController;
use App\Http\Controllers\Api\V1\AcademicYearController;
use App\Http\Controllers\Api\V1\BatchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Authentication Routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    // Authenticated and Authorized Routes
    Route::middleware(['auth:sanctum', 'permission'])->group(function () {
        // User and Role Management
        Route::apiResource('users', UserController::class);
        Route::apiResource('roles', RoleController::class);

        // Core Data Management
        Route::apiResource('students', StudentController::class);
        Route::apiResource('staff', StaffController::class);
        Route::apiResource('teachers', TeacherController::class);
        Route::apiResource('guardians', GuardianController::class);
        Route::apiResource('classes', SchoolClassController::class);
        Route::apiResource('subjects', SubjectController::class);

        // School Operations
        Route::apiResource('events', EventController::class);
        Route::apiResource('exams', ExamController::class);
        Route::apiResource('leaves', LeaveRequestController::class);
        Route::apiResource('finances', FinanceController::class);
        Route::apiResource('schedules', ScheduleController::class);
        Route::apiResource('announcements', AnnouncementController::class);
        Route::apiResource('attendances', AttendanceController::class);

        // Lookups
        Route::apiResource('academic-years', AcademicYearController::class)->except(['show']);
        Route::apiResource('batches', BatchController::class)->except(['show']);
    });
});
