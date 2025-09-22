<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FichaMedicaController;
use App\Http\Controllers\HistoriaClinicaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ORMController;

/*
| Aquí se registran las rutas de tu API.
| Estas rutas están protegidas por el middleware "api".
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 📌 Rutas principales de tu API
Route::apiResource('users', UserController::class);
Route::apiResource('fichas-medicas', FichaMedicaController::class);
Route::apiResource('historias-clinicas', HistoriaClinicaController::class);
Route::apiResource('citas', CitaController::class);
Route::apiResource('examenes', ExamenController::class);


//Consultas anidadas 


Route::get('/usuarios-fichas', [ORMController::class, 'usuariosConFichas']);
Route::get('/fichas-filtro', [ORMController::class, 'fichasConFiltro']);
Route::get('/usuarios-historia', [ORMController::class, 'usuariosConHistoria']);

