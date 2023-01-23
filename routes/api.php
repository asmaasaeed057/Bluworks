<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProblemSolvingController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-count-numbers',[ProblemSolvingController::class,'getCountNumbers']);
Route::get('get-index-of-string',[ProblemSolvingController::class,'getIndexOfString']);
Route::get('get_min_steps_to_zero',[ProblemSolvingController::class,'getMinStepsToZero']);


Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class, ['except'=> ['store']]);
});