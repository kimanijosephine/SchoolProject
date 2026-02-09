<?php

namespace App\Http\Controllers\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\Sponsors;

class FrontendController extends Controller
{
    public function index()
    {
        $sponsorId = auth('sponsor')->id();
        // Eager load students and their associated school
        $sponsor = Sponsors::with(['students.school'])->find($sponsorId);

        if (! $sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }
        // 1. Total Students
        $totalStudents = $sponsor->students->count();
        // 2. Students Per Year
        $studentsPerYear = $sponsor->students
            ->groupBy('year_of_study')
            ->map(fn ($group) => $group->count());

        // 3. School Breakdown (Uses the 'name' attribute from the related School model)
        $schoolBreakdown = $sponsor->students
            ->groupBy(function ($student) {
                return $student->school->name ?? 'Unknown School';
            })
            ->map(fn ($group) => $group->count());

        return response()->json([
            'company_name' => $sponsor->company_name,
            'total_budget' => $sponsor->total_budget, // The new column
            'total_students' => $totalStudents,
            'studentsPerYear' => $studentsPerYear,
            'school_breakdown' => $schoolBreakdown,
        ]);
    }
}
