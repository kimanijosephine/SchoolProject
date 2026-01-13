<?php
use App\Http\Controllers\School\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\School\StudentImportController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/status', function(){
    return response()->json(['status'=>'ok']);
});


// AUthentication routes
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

// Protected routes for schools
Route::middleware('auth:school')->group(function () {
    Route::post('/school/upload/{type}', [StudentImportController::class, 'import']);
    Route::get('/school/dashboard-stats',[SchoolController::class, 'getDashboardStats']);
    Route::get('/school/students', [SchoolController::class, 'getStudents']);
});
