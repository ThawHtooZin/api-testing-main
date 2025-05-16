<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    /**
     * Display the specified student.
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $student = Student::create($request->all());
        return response()->json($student);
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return response()->json($student);
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
