<?php

use App\Http\Controllers\Api\TransactionsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return response()->json([
        'api' => 'Financial Trasanctions',
        'success' => true,
        'version' => '1.0',
        'dev' => 'Jean dos anjos'
    ]);
});


Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('', 'index');
    Route::post('', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
});

Route::controller(TransactionsController::class)->prefix('transactions')->group(function () {
    Route::post('', 'store');
});
