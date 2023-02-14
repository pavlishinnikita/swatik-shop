<?php

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\GoodController;
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

Route::get('/good', [GoodController::class, 'good']);
Route::get('/buy-good', [GoodController::class, 'buy']);
Route::post('/buy-good', [GoodController::class, 'buy']);

Route::get('/test', function (\Illuminate\Http\Request $request) {
    return response()->json(['test' => 'wtf']);
    return view('_partials/good_type_goods');
});
