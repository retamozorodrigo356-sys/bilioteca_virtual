<?php

namespace App\Http\Controllers;

use App\Models\Traductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TraductorController extends Controller
{
    public function index()
    {
        $traductores = Traductor::all();
        return view('traductores.index', compact('traductores'));
    }

    public function create()
    {
        return view('traductores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'idioma_nativo' => 'nullable|string|max:255',
            'idiomas_traduccion' => 'nullable|string|max:255',
            'certificaciones' => 'nullable|string|max:255',
            'img_traductores' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_traductores')) {
            $data['img_traductores'] = $request->file('img_traductores')->store('traductores', 'public');
        }

        Traductor::create($data);

        return redirect()->route('traductores.index')->with('success', 'Traductor guardado correctamente');
    }

    public function edit($id)
    {
        $traductor = Traductor::findOrFail($id);
        return view('traductores.edit', compact('traductor'));
    }

    public function update(Request $request, $id)
    {
        $traductor = Traductor::findOrFail($id);

        $data = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'idioma_nativo' => 'nullable|string|max:255',
            'idiomas_traduccion' => 'nullable|string|max:255',
            'certificaciones' => 'nullable|string|max:255',
            'img_traductores' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_traductores')) {
            if ($traductor->img_traductores) {
                Storage::disk('public')->delete($traductor->img_traductores);
            }
            $data['img_traductores'] = $request->file('img_traductores')->store('traductores', 'public');
        }

        $traductor->update($data);

        return redirect()->route('traductores.index')->with('success', 'Traductor actualizado correctamente');
    }

    public function destroy($id)
    {
        $traductor = Traductor::findOrFail($id);
        if ($traductor->img_traductores) {
            Storage::disk('public')->delete($traductor->img_traductores);
        }
        $traductor->delete();

        return redirect()->route('traductores.index')->with('success', 'Traductor eliminado');
    }
}
