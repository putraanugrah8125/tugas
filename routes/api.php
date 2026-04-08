<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;

Route::get('/anggota', [AnggotaController::class, 'index']);
Route::get('/anggota/{id}', [AnggotaController::class, 'show']);
Route::post('/anggota', [AnggotaController::class, 'store']);
Route::put('/anggota/{id}', [AnggotaController::class, 'update']);
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy']);