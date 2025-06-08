<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/* Route::get('/equipos', [EquiposController::class, 'index']); */
Route::get('/equipos', 'App\Http\Controllers\EquiposController@index');

Route::post('/nuevo_equipo', 'App\Http\Controllers\EquiposController@nuevo_equipo');

/*
Route::post('/artistas', [ArtistaController::class, 'store']);
Route::get('/artistas/{id}', [ArtistaController::class, 'show']);
Route::put('/artistas/{id}', [ArtistaController::class, 'update']);
Route::delete('/artistas/{id}', [ArtistaController::class, 'destroy']);
*/