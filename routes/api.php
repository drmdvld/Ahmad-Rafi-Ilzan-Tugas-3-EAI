<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FoodController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/food', [FoodController::class, "index"]);
Route::get('/food/{id}', [FoodController::class, "show"]);
Route::post('/food', [FoodController::class, "store"]);
Route::patch('/food/{id}', [FoodController::class, "update"]);
Route::delete('/food/{id}', [FoodController::class, "destroy"]);
