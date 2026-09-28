<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\TraductorController;

Route::get('/', function () {
    return redirect()->route('libros.index');
});

Route::resource('libros', LibroController::class);
Route::resource('autores', AutorController::class);
Route::resource('editores', EditorController::class);
Route::resource('traductores', TraductorController::class);
