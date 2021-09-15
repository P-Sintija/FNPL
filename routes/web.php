<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputController;

Route::get('/', [HomeController::class, 'show'])->name('home.show');
Route::post('/result', [InputController::class, 'execute'])->name('result.execute');
