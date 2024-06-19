<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProvincesController;


Route::post("/", function() {
    return "Hello";
});

Route::prefix("search")->group(function () {
    Route::get('cities', [CitiesController::class, 'getCities']);
    Route::get('province', [ProvincesController::class, 'getProvince']);
});