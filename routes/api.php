<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginController;


Route::post('/register', [LoginController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);
Route::put('/update', [LoginController::class, 'update']);
Route::delete('/delete', [LoginController::class, 'deleteByEmail']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
