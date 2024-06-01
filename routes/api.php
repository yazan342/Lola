<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::group(['middleware' => ['auth:api']], function () {

    Route::post('/user/update', [AuthController::class, 'updateUser']);
    Route::get('/user/info', [AuthController::class, 'getUserInfo']);
    Route::post('logout', [AuthController::class, 'logout']);


    Route::get('/get-categories', [HomeController::class, 'getCategories']);
    Route::get('/get-cakes/{category_id}', [HomeController::class, 'getCakesByCategory']);


    Route::get('/cart', [CartController::class, 'getUserCart']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::delete('/cart/remove/{cake_id}', [CartController::class, 'removeCakeFromCart']);
});
