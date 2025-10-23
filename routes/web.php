<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OdooController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/odoo/login', [OdooController::class, 'showLoginForm'])->name('odoo.login.form');
Route::post('/odoo/login', [OdooController::class, 'login'])->name('odoo.login');
Route::get('/odoo/partners', [OdooController::class, 'partners'])->name('odoo.partners');