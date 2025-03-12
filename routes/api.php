<?php

use App\Http\Controllers\MonitorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckApiToken;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware(CheckApiToken::class)->group(function () {
    Route::apiResource('monitors', MonitorController::class);
});
