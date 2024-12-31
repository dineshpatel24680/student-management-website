<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', [StudentController::class, 'index']);

// API routes
Route::get('/api/students', [StudentController::class, 'apiIndex']);
Route::post('/api/students', [StudentController::class, 'store']);
Route::delete('/api/students/{id}', [StudentController::class, 'destroy']);

