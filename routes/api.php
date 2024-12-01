<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\movieController;

Route::get('/peliculas', [movieController::class, 'index']);

route::get('/peliculas/{id}', [movieController::class, 'show']);

Route::post('/peliculas', [movieController::class, 'store']);

Route::put('/peliculas/{id}', [movieController::class, 'update']);

Route::patch('/peliculas/{id}', [movieController::class, 'updatePartial']);

Route::delete('/peliculas/{id}', [movieController::class, 'destroy']);
