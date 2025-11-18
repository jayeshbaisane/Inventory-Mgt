<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\InwardController;
use App\Http\Controllers\ManageController;

// Redirect home to manage page
Route::get('/', [ManageController::class, 'index'])->name('manage.index');

// Category CRUD
Route::resource('categories', CategoryController::class);

// Material CRUD
Route::resource('materials', MaterialController::class);

// Inward/Outward CRUD
Route::resource('inwards', InwardController::class);
