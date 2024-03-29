<?php

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\EnotController;
use App\Http\Controllers\GoodController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DefaultController::class, 'index']);
Route::get('/congratulation', [DefaultController::class, 'congratulation']);
Route::get('/error', [DefaultController::class, 'error']);

Route::get('/good', [GoodController::class, 'good']);
Route::get('/good-category', [GoodController::class, 'goodCategory']);
Route::post('/buy-good', [GoodController::class, 'buy']);
Route::get('/goods-list', [GoodController::class, 'list']);

Route::get('/mono-hook', [GoodController::class, 'monoWebHook'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/mono-hook', [GoodController::class, 'monoWebHook'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::get('/enotio-hook', [EnotController::class, 'hook']);
Route::post('/enotio-hook', [EnotController::class, 'hook']);


Route::get('/privacy/pdf', [DefaultController::class, 'privacy']);
Route::get('/contract/pdf', [DefaultController::class, 'contract']);

