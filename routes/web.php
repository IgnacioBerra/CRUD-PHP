<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\Api\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return ('welcome');
});

Route::post('/register', [LoginController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/update', [LoginController::class, 'update']);
Route::delete('/delete', [LoginController::class, 'deleteByEmail']);