<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::delete('/user/{id}', [DashboardController::class, 'deleteUser'])->name('user.delete');
Route::get('/user/{id}', [DashboardController::class, 'showUser'])->name('user.profile');
Route::post('/cakes', [DashboardController::class, 'storeCake'])->name('cake.store');
Route::get('/cakes/{cake}/edit', [DashboardController::class, 'editCake'])->name('cake.edit');
Route::put('/cakes/{cake}', [DashboardController::class, 'update'])->name('cake.update');
Route::delete('/cakes/{cake}', [DashboardController::class, 'destroyCake'])->name('cake.delete');

// Route to display a specific order
Route::get('/orders/{order}', [DashboardController::class, 'showOrder'])->name('order.view');

// Route to delete an order
Route::delete('/orders/{order}', [DashboardController::class, 'destroyOrder'])->name('order.delete');


Route::get('/flavors/create', [DashboardController::class, 'createFlavor'])->name('flavor.create');
Route::post('/flavors', [DashboardController::class, 'storeFlavor'])->name('flavor.store');
Route::get('/flavors/{flavor}/edit', [DashboardController::class, 'editFlavor'])->name('flavor.edit');
Route::put('/flavors/{flavor}', [DashboardController::class, 'updateFlavor'])->name('flavor.update');
Route::delete('/flavors/{flavor}', [DashboardController::class, 'destroyFlavor'])->name('flavor.delete');



Route::get('/shapes/{shape}/edit', [DashboardController::class, 'editShape'])->name('shape.edit');
Route::put('/shapes/{shape}', [DashboardController::class, 'updateShape'])->name('shape.update');
Route::delete('/shapes/{shape}', [DashboardController::class, 'destroyShape'])->name('shape.delete');
Route::post('/shapes', [DashboardController::class, 'storeShape'])->name('shape.store');


Route::get('/toppings/{topping}/edit', [DashboardController::class, 'editTopping'])->name('topping.edit');
Route::put('/toppings/{topping}', [DashboardController::class, 'updateTopping'])->name('topping.update');
Route::delete('/toppings/{topping}', [DashboardController::class, 'destroyTopping'])->name('topping.delete');
Route::post('/toppings', [DashboardController::class, 'storeTopping'])->name('topping.store');



Route::get('/colors/{color}/edit', [DashboardController::class, 'editColor'])->name('color.edit');
Route::put('/colors/{color}', [DashboardController::class, 'updateColor'])->name('color.update');
Route::delete('/colors/{color}', [DashboardController::class, 'destroyColor'])->name('color.delete');
Route::post('/colors', [DashboardController::class, 'storeColor'])->name('color.store');
