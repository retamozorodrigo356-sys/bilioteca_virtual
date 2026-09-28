<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AutorController extends Controller
{
    public function index()
    {
        $autores = Autor::all();
        return view('autores.index', compact('autores'));
    }

    public function create()
    {
        return view('autores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
            'img_autores' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_autores')) {
            $data['img_autores'] = $request->file('img_autores')->store('autores', 'public');
        }

        Autor::create($data);

        return redirect()->route('autores.index')->with('success', 'Autor guardado correctamente');
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.edit', compact('autor'));
    }

    public function update(Request $request, $id)
    {
        $autor = Autor::findOrFail($id);

        $data = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
            'img_autores' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_autores')) {
            if ($autor->img_autores) {
                Storage::disk('public')->delete($autor->img_autores);
            }
            $data['img_autores'] = $request->file('img_autores')->store('autores', 'public');
        }

        $autor->update($data);

        return redirect()->route('autores.index')->with('success', 'Autor actualizado correctamente');
    }

    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);
        if ($autor->img_autores) {
            Storage::disk('public')->delete($autor->img_autores);
        }
        $autor->delete();

        return redirect()->route('autores.index')->with('success', 'Autor eliminado');
    }
}
