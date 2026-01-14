<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Notifications\FirstLoginResetPassword;

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
        $user = Auth::guard($role)->user();

    // Logic for First Time Student Login
    if ($role === 'student' && $user->is_first_login) {
        // 1. Generate a password reset token
        $resetToken = Password::getRepository()->create($user);

        // 2. Send the custom notification
        $user->notify(new FirstLoginResetPassword($resetToken));

        // 3. Update the flag so they don't get emailed every time
        // until they actually change the password
        // $user->is_first_login = false;
        $user->save();

        return response()->json([
            'message' => 'First login detected. A password reset link has been sent to your email.',
            'first_login' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'role' => $role
        ]);
    }

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
