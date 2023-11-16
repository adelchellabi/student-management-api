<?php

use App\Http\Controllers\Api\Students\GetStudentsController;
use App\Http\Controllers\AppInfoController;
use App\Http\Controllers\HealthCheckController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('health-check', [HealthCheckController::class, 'check']);
Route::get('app-info', [AppInfoController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('students')->group(function () {
        Route::get('/', GetStudentsController::class);
        // Route::post('/', CreateStudentController::class);
        // Route::get('/{studentId}', GetStudentController::class);
        // Route::patch('/{studentId}', UpdateStudentController::class);
        // Route::delete('/{studentId}', CreateStudentController::class);
    });
});
