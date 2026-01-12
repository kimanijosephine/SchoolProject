<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validate incoming request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:school,student,sponsor', // Crucial for Multi-Auth
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');
        $role = $request->role;

        // 2. Attempt login using the specific JWT guard defined in config/auth.php
        // This will check the specific table (schools, students, or sponsors)
        if (!$token = Auth::guard($role)->attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials for ' . $role], 401);
        }

        // 3. Return the token and user data to your Vue frontend
        return $this->respondWithToken($token, $role);
    }

    protected function respondWithToken($token, $role)
    {   // retrieve user and hide sensitive fields
        $user = Auth::guard($role)->user();
        $user->makeHidden(['id', 'password', 'created_at', 'updated_at']);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard($role)->factory()->getTTL() * 60,
            'user' =>$user,
            //'user' => Auth::guard($role)->user(),
            'role' => $role
        ]);
    }

    public function logout(Request $request)
    {
        $role = $request->header('X-User-Role'); // You can pass this from Vue
        if ($role) {
            Auth::guard($role)->logout();
        }
        return response()->json(['message' => 'Successfully logged out']);
    }
}
