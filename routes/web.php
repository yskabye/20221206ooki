<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RestrantController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MailingController;

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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('/done', [ReserveController::class, 'create']);
    Route::get ('/mypage', [FavoriteController::class, 'mypage']);
    Route::get ('/update', [ReserveController::class, 'correct']);
    Route::post('/redone', [ReserveController::class, 'update']);
    Route::get ('/history', [ReviewController::class, 'dsphistory']);

    Route::get ('/qrcode/{id}', [ReserveController::class,'qrcode']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get ('/admin/rsv_list',   [ReserveController::class, 'listing']);
    Route::get ('/admin/store_edit', [RestrantController::class, 'editstore']);
    Route::post('/admin/store_upd',  [RestrantController::class, 'update']);

    Route::get ('/admin/user_list', [UserController::class, 'index']);
    Route::get ('/admin/user_edit', [UserController::class, 'edit']);
    Route::post('/admin/user_upd',  [UserController::class, 'update']);

    Route::get ('/admin/mailing',  [MailingController::class, 'index']);
    Route::post('/admin/mailsave', [MailingController::class, 'update']);
    Route::post('/admin/mailsend', [MailingController::class, 'sendmail']);

    Route::get ('/admin/qrreader', [ReserveController::class,'zoomin']);
    Route::get ('/admin/checkin',  [ReserveController::class,'checkin']);
});

require __DIR__ . '/auth.php';