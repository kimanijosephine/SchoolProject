<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //
    public function getDashboardStats(Request $request)
    {
        $stats = [
            'total_students' =>1500,
            'active_courses' =>45,
            'pending_fees' =>12000,
            'studentsPerYear' => [
                '2020' => 300,
                '2021' => 400,
                '2022' => 500,
                '2023' => 300,
            ],
        ];
        return response()->json($stats);
    }
}
