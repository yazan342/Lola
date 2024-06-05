<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CakeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
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
    Route::get('/get-cake/{cake_id}', [HomeController::class, 'getCakeById']);


    Route::get('/cart', [CartController::class, 'getUserCart']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::delete('/cart/remove/{cake_id}', [CartController::class, 'removeCakeFromCart']);


    Route::post('/cake/create', [CakeController::class, 'createCake']);
    Route::post('/cake/update/{cake_id}', [CakeController::class, 'updateCake']);
    Route::delete('/cake/delete/{cake_id}', [CakeController::class, 'destroy']);


    Route::post('/category/create', [CategoryController::class, 'createCategory']);
    Route::post('/category/update/{category_id}', [CategoryController::class, 'updateCategory']);
    Route::delete('/category/delete/{category_id}', [CategoryController::class, 'destroy']);
});
