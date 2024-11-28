<?php

use App\Http\Controllers\Api\v1\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->group(function (): void {
  Route::get('/properties/search', [PropertyController::class, 'search']);
  Route::apiResource("/properties", PropertyController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
