<?php

namespace App\Http\Controllers\Sponsor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $sponsor = Auth::user();
        $totalStudents = $sponsor->students()->count();

        // 3. Fetch students grouped by their academic year
        // This assumes your students table has a 'year' column (e.g., 1, 2, 3, 4)
        $studentsPerYear = $sponsor->students()
            ->selectRaw('year, count(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('count', 'year'); // Returns format: {"2024": 5, "2025": 10}

        // 4. Return the response in the structure your Frontend expects
        return response()->json([
            'total_students' => $totalStudents,
            'studentsPerYear' => $studentsPerYear,
            'message' => 'Sponsor dashboard stats fetched successfully'
        ], 200);
    }
}
