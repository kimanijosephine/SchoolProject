<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/status', function(){
    return response()->json(['status'=>'ok']);
});


// AUthentication routes
Route::post('/login', [LoginController::class, 'login']);
