<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

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

Route::get('/v1/favorite/{id}', [FavoriteController::class, 'shows']);
Route::post('/v1/favorite', [FavoriteController::class, 'store']);
Route::delete('/v1/favorite/{id}', [FavoriteController::class, 'destroy']);

Route::apiResource('/v1/reserve', ReserveController::class)->only([
    'destroy'
]);

Route::post('/v1/review', [ReviewController::class, 'store']);

Route::delete('/v1/user/{id}', [UserController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});