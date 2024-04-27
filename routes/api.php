<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\EnsureEmployeeExists;
use App\Http\Middleware\EnsureValidProvider;

Route::middleware([EnsureValidProvider::class])->group(function () {
    Route::post('/employees/{provider}', [EmployeeController::class, 'create']);
    Route::post('/employees/{provider}/{id}', [EmployeeController::class, 'update'])->middleware(EnsureEmployeeExists::class);;
});
