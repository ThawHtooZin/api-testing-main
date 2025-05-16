<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
        if ($request->isMethod('post') && empty($request->all())) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'grade' => ['The grade field is required.'],
                    'guardian_name' => ['The guardian name field is required.']
                ]
            ], 422);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'grade' => 'required|string|max:50',
                'guardian_name' => 'required|string|max:255',
            ]);

            $student = Student::create($validated);
            return response()->json($student, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        if ($request->isMethod('put') && empty($request->all())) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['At least one field must be provided for update.'],
                    'email' => ['At least one field must be provided for update.'],
                    'grade' => ['At least one field must be provided for update.'],
                    'guardian_name' => ['At least one field must be provided for update.']
                ]
            ], 422);
        }

        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => [
                    'sometimes',
                    'required',
                    'email',
                    Rule::unique('students')->ignore($student->id),
                ],
                'grade' => 'sometimes|required|string|max:50',
                'guardian_name' => 'sometimes|required|string|max:255',
            ]);

            $student->update($validated);
            return response()->json($student);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors()
            ], 422);
        }
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
