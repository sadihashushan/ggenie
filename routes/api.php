<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupermarketController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GenieController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Genie\HomeController;
use App\Http\Controllers\Genie\Auth\LoginController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Genie Authentication
Route::post('/genie/login', [LoginController::class, 'login']);
Route::post('/genie/logout', [LoginController::class, 'logout']);

//Users
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

//Supermarkets
Route::get('/supermarkets', [SupermarketController::class, 'index']);
Route::post('/supermarkets', [SupermarketController::class, 'store']);
Route::get('/supermarkets/{id}', [SupermarketController::class, 'show']);
Route::put('/supermarkets/{id}', [SupermarketController::class, 'update']);
Route::get('/supermarkets/slug/{slug}', [SupermarketController::class, 'showBySlug']); 
Route::delete('/supermarkets/{id}', [SupermarketController::class, 'destroy']);

//Reviews
Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);
Route::put('/reviews/{id}', [ReviewController::class, 'update']);
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

//Orders
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
});

// Genie Orders
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/genie/orders/{order}/accept', [HomeController::class, 'acceptOrder']);
    Route::post('/genie/orders/{order}/decline', [HomeController::class, 'declineOrder']);
    Route::post('/genie/orders/{order}/complete', [HomeController::class, 'completeOrder']);
    Route::post('/genie/orders/{order}/fail', [HomeController::class, 'failOrder']);
    Route::get('/genie/orders/new', [HomeController::class, 'newOrders']);
    Route::get('/genie/orders/ongoing', [HomeController::class, 'ongoingOrders']);
    Route::get('/genie/orders/completed', [HomeController::class, 'completedOrders']);
    Route::post('/genie/logout', [LoginController::class, 'logout']);
});

//Genies
Route::get('/genies', [GenieController::class, 'index']);
Route::post('/genies', [GenieController::class, 'store']);
Route::get('/genies/{id}', [GenieController::class, 'show']);
Route::put('/genies/{id}', [GenieController::class, 'update']);
Route::delete('/genies/{id}', [GenieController::class, 'destroy']);

//Addresses
Route::get('/addresses', [AddressController::class, 'index']);
Route::get('/addresses/{id}', [AddressController::class, 'show']);
Route::put('/addresses/{id}', [AddressController::class, 'update']);
Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/addresses', [AddressController::class, 'store']);
});