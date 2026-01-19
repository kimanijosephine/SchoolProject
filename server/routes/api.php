<?php
use App\Http\Controllers\School\SchoolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\School\StudentImportController;
use App\Http\Controllers\Sponsor\FrontendController;
use App\Http\Controllers\Sponsor\WalletController;

Route::get('/status', function(){
    return response()->json(['status'=>'ok']);
});


// AUthentication routes
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/reset-password', [LoginController::class, 'resetPassword']);
Route::post('/logout', [LoginController::class, 'logout']);

// Protected routes for schools
Route::middleware('auth:school')->group(function () {
    Route::post('/school/upload/{type}', [StudentImportController::class, 'import']);
    Route::get('/school/dashboard-stats',[SchoolController::class, 'getDashboardStats']);
    Route::get('/school/students', [SchoolController::class, 'getStudents']);
});
Route::middleware('auth:sponsor')->group(function () {
    Route::get('/sponsor-portal',[FrontendController::class, 'index']);
    Route::get('/sponsor/my-students',[FrontendController::class, 'myStudents']);
    Route::get('/sponsor/my-wallet', [WalletController::class, 'index']);
});
