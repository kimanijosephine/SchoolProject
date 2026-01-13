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
        ];
        return response()->json($stats);
    }
}
