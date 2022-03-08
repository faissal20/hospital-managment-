<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;

use App\Models\Department;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
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

Route::get('/doctors' , [DoctorController::class, 'index']);
Route::get('/doctors/{user}' , [DoctorController::class, 'show']);
Route::post('/doctors' , [DoctorController::class, 'store']);
Route::put('/doctors/{doctor}' , [DoctorController::class, 'update']);



Route::resource('users' , UserController::class);

Route::resource('departments' , DepartmentController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
