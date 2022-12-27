<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RestrantController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/session', [SessionController::class, 'getSes']);
Route::post('/session', [SessionController::class, 'postSes']);

Route::get('/', [RestrantController::class, 'index']);
Route::get('/detail/{id}', [RestrantController::class, 'detail']);

Route::group(['middleware' => ['auth']], function () {
    Route::post('/done', [ReserveController::class, 'create']);
    Route::get('/mypage', [FavoriteController::class, 'mypage']);
    Route::get('/update', [ReserveController::class, 'correct']);
    Route::post('/redone', [ReserveController::class, 'update']);
    Route::get('/history', [ReviewController::class, 'dsphistory']);
});

require __DIR__ . '/auth.php';