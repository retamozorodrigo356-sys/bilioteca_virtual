<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Autor;
use App\Models\Editor;
use App\Models\Traductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    // 1. Mostrar la lista de libros
    public function index()
    {
        $libros = Libro::with(['autor', 'editor', 'traductor'])->get();
        return view('libros.index', compact('libros'));
    }

    // 2. Mostrar formulario para agregar libro
    public function create()
    {
        $autores = Autor::all();
        $editores = Editor::all();
        $traductores = Traductor::all();
        return view('libros.create', compact('autores', 'editores', 'traductores'));
    }

    // 3. Guardar el libro nuevo en la base de datos
    public function store(Request $request)
    {
        $data = $request->validate([
            'Titulo' => 'required|string|max:255',
            'Tipo' => 'required|string|max:255',
            'ID_autor' => 'required|exists:autores,ID_autores',
            'ID_editor' => 'required|exists:editores,ID_editores',
            'ID_traductor' => 'required|exists:traductores,ID_traductores',
            'genero' => 'nullable|string|max:255',
            'img_libros' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_libros')) {
            $data['img_libros'] = $request->file('img_libros')->store('libros', 'public');
        }

        Libro::create($data);

        return redirect()->route('libros.index')->with('success', '¡Libro agregado correctamente!');
    }

    // 4. Mostrar formulario para editar libro
    public function edit($id)
    {
        $libro = Libro::findOrFail($id);
        $autores = Autor::all();
        $editores = Editor::all();
        $traductores = Traductor::all();
        return view('libros.edit', compact('libro', 'autores', 'editores', 'traductores'));
    }

    // 5. Actualizar los datos del libro
    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);

        $data = $request->validate([
            'Titulo' => 'required|string|max:255',
            'Tipo' => 'required|string|max:255',
            'ID_autor' => 'required|exists:autores,ID_autores',
            'ID_editor' => 'required|exists:editores,ID_editores',
            'ID_traductor' => 'required|exists:traductores,ID_traductores',
            'genero' => 'nullable|string|max:255',
            'img_libros' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_libros')) {
            // Eliminar imagen anterior si existe
            if ($libro->img_libros) {
                Storage::disk('public')->delete($libro->img_libros);
            }
            $data['img_libros'] = $request->file('img_libros')->store('libros', 'public');
        }

        $libro->update($data);

        return redirect()->route('libros.index')->with('success', '¡Libro actualizado correctamente!');
    }

    // 6. Eliminar libro de la base de datos
    public function destroy($id)
    {
        $libro = Libro::findOrFail($id);

        if ($libro->img_libros) {
            Storage::disk('public')->delete($libro->img_libros);
        }

        $libro->delete();

        return redirect()->route('libros.index')->with('success', '¡Libro eliminado con éxito!');
    }
}
