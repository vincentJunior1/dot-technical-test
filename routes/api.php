<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\UserController;


Route::post("/login",[UserController::class, 'login']);

Route::prefix("search")->group(function () {
    Route::get('cities', [CitiesController::class, 'getCities'])->middleware('jwt.auth');
    Route::get('province', [ProvincesController::class, 'getProvince'])->middleware('jwt.auth');
});