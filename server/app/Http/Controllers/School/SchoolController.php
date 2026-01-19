<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students; // Using your plural model name

class SchoolController extends Controller
{
    public function getDashboardStats(Request $request)
    {
        $school = $request->user();

        return response()->json([
            'total_students' => $school->students()->count(),

            // Count unique courses based on course_id column
            'active_courses' => $school->students()->distinct('course_id')->count('course_id'),

            // Example for pending fees (assumes you have a column for this)
            'pending_fees'   => 0,

            // Gets counts grouped by the class_year column
            'studentsPerYear' => $school->students()
                ->selectRaw('class_year, count(*) as count')
                ->groupBy('class_year')
                ->pluck('count', 'class_year')
        ]);
    }

    public function getStudents(Request $request)
    {
        $school = $request->user();
        $year = $request->query('year');

        // Start the query from the school's relationship for security
        $query = $school->students();

        // Apply year filter if selected in frontend
        if ($year) {
            $query->where('year_of_study', $year);
        }

        // Return the results (latest first)
        return response()->json($query->latest()->get());
    }

    // Adding the status update logic for your frontend buttons
    public function updateStatus(Request $request, $id)
    {
        $school = $request->user();

        $student = $school->students()->findOrFail($id);
        $student->update([
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Status updated successfully']);
    }
}
