<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller
{
    public function index()
    {
        $editores = Editor::all();
        return view('editores.index', compact('editores'));
    }

    public function create()
    {
        return view('editores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'nombre_editorial' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'img_editores' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_editores')) {
            $data['img_editores'] = $request->file('img_editores')->store('editores', 'public');
        }

        Editor::create($data);

        return redirect()->route('editores.index')->with('success', 'Editor guardado correctamente');
    }

    public function edit($id)
    {
        $editor = Editor::findOrFail($id);
        return view('editores.edit', compact('editor'));
    }

    public function update(Request $request, $id)
    {
        $editor = Editor::findOrFail($id);

        $data = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Apellidos' => 'required|string|max:255',
            'nombre_editorial' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'img_editores' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('img_editores')) {
            if ($editor->img_editores) {
                Storage::disk('public')->delete($editor->img_editores);
            }
            $data['img_editores'] = $request->file('img_editores')->store('editores', 'public');
        }

        $editor->update($data);

        return redirect()->route('editores.index')->with('success', 'Editor actualizado correctamente');
    }

    public function destroy($id)
    {
        $editor = Editor::findOrFail($id);
        if ($editor->img_editores) {
            Storage::disk('public')->delete($editor->img_editores);
        }
        $editor->delete();

        return redirect()->route('editores.index')->with('success', 'Editor eliminado');
    }
}
