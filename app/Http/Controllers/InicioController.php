<?php

namespace App\Http\Controllers;

use App\Models\Libro;

class InicioController extends Controller
{
    // Portada de la biblioteca: muestra algunos libros del catálogo
    public function index()
    {
        $libros = Libro::with(['autor', 'editor'])
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return view('inicio.index', compact('libros'));
    }
}
