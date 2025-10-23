<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OdooApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/odoo/login', [OdooApiController::class, 'login']);
Route::post('/odoo/partners', [OdooApiController::class, 'partners']);