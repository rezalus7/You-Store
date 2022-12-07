<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\TransaksiController;

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

// SEPATU
Route::get('sepatu', [SepatuController::class, 'index']);
Route::get('sepatu/{id}', [SepatuController::class, 'show']);


// TRANSAKSI
Route::get('transaksi', [TransaksiController::class, 'index']);
Route::get('transaksi/{id}', [TransaksiController::class, 'show']);

// AUTHENTICATION
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('sepatu', SepatuController::class)->except(
        ['create', 'edit', 'index', 'show']
    );
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('transaksi', TransaksiController::class)->except(
        ['create', 'edit', 'index', 'show']
    );
    Route::get('/account', [AuthController::class, 'alluser']);
    Route::get('/account/{id}', [AuthController::class, 'showuser']);
});