<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Schools;
use App\Models\Students;
use App\Models\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $role = $request->role;

        // 1. Validate based on role
        $rules = [
            'email' => 'required|email|unique:schools,email|unique:students,email|unique:sponsors,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:school,student,sponsor',
        ];

        // Add role-specific validation
        if ($role === 'school') {
            $rules['name'] = 'required|string|max:255';
        } elseif ($role === 'student') {
            $rules['name'] = 'required|string|max:255';
            $rules['school_id'] = 'required|exists:schools,id';
            $rules['year_of_study'] = 'required';
            $rules['class_year'] = 'required';
        } elseif ($role === 'sponsor') {
            $rules['company_name'] = 'required|string|max:255';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Create User based on role
        $user = $this->createUser($role, $request->all());

        // 3. Generate JWT Token immediately so they are logged in after registration
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Registration successful',
            'token' => $token,
            'user' => $user,
            'role' => $role
        ], 201);
    }

    protected function createUser($role, array $data)
    {
        if ($role === 'school') {
            return Schools::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }

        if ($role === 'student') {
            return Students::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'school_id' => $data['school_id'],
                'course_id' => $data['course_id'] ?? null,
                'year_of_study' => $data['year_of_study'],
                'class_year' => $data['class_year'],
                'password' => Hash::make($data['password']),
            ]);
        }

        if ($role === 'sponsor') {
            return Sponsors::create([
                'company_name' => $data['company_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
