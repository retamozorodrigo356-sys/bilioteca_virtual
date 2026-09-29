<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\TraductorController;
use App\Http\Controllers\InicioController;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::resource('libros', LibroController::class);
Route::resource('autores', AutorController::class);
Route::resource('editores', EditorController::class);
Route::resource('traductores', TraductorController::class);
