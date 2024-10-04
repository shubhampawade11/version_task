<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'ShowForm']);
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::resource('user', UserController::class);
Route::get('/user', [UserController::class, 'index'])->name('search');