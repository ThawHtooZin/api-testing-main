<?php

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'crud-project'], function () {
    // Get all students
    Route::get('/students', function () {
        $students = Student::all();
        return response()->json($students);
    });

    // Get a specific student
    Route::get('/students/{id}', function ($id) {
        $student = Student::findOrFail($id);
        return response()->json($student);
    });

    // Create a new student
    Route::post('/students', function (Request $request) {
        $student = Student::create($request->all());
        return response()->json($student);
    });

    // Update a student
    Route::put('/students/{id}', function (Request $request, $id) {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student);
    });

    // Delete a student
    Route::delete('/students/{id}', function ($id) {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    });
});

