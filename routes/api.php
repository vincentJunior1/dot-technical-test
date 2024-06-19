<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProvincesController;


Route::post("/", function() {
    return "Hello";
});

Route::prefix("search")->group(function () {
    Route::get('cities/{id}', [CitiesController::class, 'getCities']);
    Route::get('province/{id}', [ProvincesController::class, 'getProvince']);
});