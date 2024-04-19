<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\proyectController;


Route::get('/proyects',[proyectController::class, 'index']);

Route::get('/proyects/{id}',[proyectController::class, 'show']);

Route::post('/proyects', [proyectController::class, 'store']);

Route::put('/proyects/{id}', [proyectController::class, 'update']);

Route::put('/proyects/{id}', [proyectController::class, 'updatePartial']);

Route::delete('/proyects/{id}', [proyectController::class, 'destroy']);