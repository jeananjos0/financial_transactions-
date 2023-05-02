<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function(){
    return response()->json([
        'success'=>true
    ]);
});



Route::controller(UserController::class)->prefix('users')->group(function(){
    Route::get('', 'index');    
    Route::post('', 'store'); 
});

