<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth', [AuthController::class, 'login']);

Route::middleware(['auth:api', 'check.role:manager'])->group(function () {
    Route::post('/lead', [LeadController::class, 'store']);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/lead/{id}', [LeadController::class, 'show']);
    Route::get('/leads', [LeadController::class, 'index']);
});