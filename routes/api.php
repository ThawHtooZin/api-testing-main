<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'student-crud'], function () {
    // Get all students
    Route::get('/students', [StudentController::class, 'index']);

    // Get a specific student
    Route::get('/students/{id}', [StudentController::class, 'show']);

    // Create a new student
    Route::post('/students', [StudentController::class, 'store']);

    // Update a student
    Route::put('/students/{id}', [StudentController::class, 'update']);

    // Delete a student
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);
});

