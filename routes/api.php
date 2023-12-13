<?php

use App\Http\Controllers\Api\Location\Controller\LocationController;
use App\Http\Middleware\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware([RateLimiter::class])->group(function () {
    Route::apiResource('location',LocationController::class);
    Route::get('rotates',[LocationController::class,"rotates"]);
});