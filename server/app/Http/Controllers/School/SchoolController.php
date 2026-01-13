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
    public function getStudents(Request $request){
        $year = $request->query('year');
        //dummy data
        $students = [
    [
        'id' => 1,
        'name' => 'Alice Johnson',
        'registration_number' => 'REG-001',
        'course_id' => 'CS-101',
        'year_of_study' => 2,
        'class_year' => 2021,
        'email' => 'alice@example.com',
        'school_id' => 'SCH-A',
        'status' => 'active',
        // 'marks' => [] // Optional
    ],
    [
        'id' => 2,
        'name' => 'Bob Smith',
        'registration_number' => 'REG-002',
        'course_id' => 'ENG-202',
        'year_of_study' => 1,
        'class_year' => 2022,
        'email' => 'bob@example.com',
        'school_id' => 'SCH-A',
        'status' => 'suspended',
    ],
    [
        'id' => 3,
        'name' => 'Charlie Brown',
        'registration_number' => 'REG-003',
        'course_id' => 'CS-101',
        'year_of_study' => 2,
        'class_year' => 2021,
        'email' => 'charlie@example.com',
        'school_id' => 'SCH-A',
        'status' => 'active',
    ],
    [
        'id' => 4,
        'name' => 'Diana Prince',
        'registration_number' => 'REG-004',
        'course_id' => 'ART-303',
        'year_of_study' => 1,
        'class_year' => 2023,
        'email' => 'diana@example.com',
        'school_id' => 'SCH-A',
        'status' => 'expelled',
    ],
];
        return response()->json($students);
    }
}
