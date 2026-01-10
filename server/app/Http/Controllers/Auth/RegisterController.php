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
    protected function respondWithToken($token, $user, $role)
{
    // 1. Hide sensitive/unnecessary fields
    $user->makeHidden(['id', 'password', 'created_at', 'updated_at']);

    // 2. Use the specific guard to get the TTL
    // This ensures the 7-hour (420 min) setting you created is picked up correctly
    $ttl = auth($role)->factory()->getTTL() * 60;

    return response()->json([
        'access_token' => $token,
        'token_type'   => 'bearer',
        'expires_in'   => $ttl,
        'user'         => $user,
        'role'         => $role
    ]);
}

public function register(Request $request)
{
    $role = $request->role;

    // 1. Validation (Keep your existing validation logic)
    $rules = [
        'email' => 'required|email|unique:schools,email|unique:students,email|unique:sponsors,email',
        'password' => 'required|string|min:6',
        'role' => 'required|in:school,student,sponsor',
    ];

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

    // 2. Create User
    $user = $this->createUser($role, $request->all());

    // 3. Generate Token
    $token = JWTAuth::fromUser($user);

    // 4. Return identical structure to Login
    return $this->respondWithToken($token, $user, $role);
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
