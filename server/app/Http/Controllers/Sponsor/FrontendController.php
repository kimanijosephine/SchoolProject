<?php

namespace App\Http\Controllers\Sponsor;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponsors;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $sponsorId = auth('sponsor')->id();
        $sponsor = Sponsors::with(['students.school_id'])->find($sponsorId);

        if (!$sponsor) {
            return response()->json(['message' => 'Sponsor not found'], 404);
        }
        // 1. Total Students
        $totalStudents = $sponsor->students->count();

        // 2. Students per Year (e.g., {"2024": 5, "2025": 2})
        $studentsPerYear = $sponsor->students
            ->groupBy('year_of_study')
            ->map(fn($group) => $group->count());

        // 3. School Breakdown (Mapping how many students are in which school)
        $schoolBreakdown = $sponsor->students
            ->groupBy('school.name')
            ->map(fn($group) => $group->count());

        return response()->json([
            'total_students' => $totalStudents,
            'studentsPerYear' => $studentsPerYear,
            'school_breakdown' => $schoolBreakdown,
            'company_name' => $sponsor->company_name
        ]);
    }
}
