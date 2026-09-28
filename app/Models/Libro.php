<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';
    protected $primaryKey = 'ID_libro';
    protected $fillable = ['Titulo', 'Tipo', 'ID_autor', 'ID_editor', 'ID_traductor', 'genero', 'img_libros'];
    public $timestamps = false;

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'ID_autor', 'ID_autores');
    }

    public function editor()
    {
        return $this->belongsTo(Editor::class, 'ID_editor', 'ID_editores');
    }

    public function traductor()
    {
        return $this->belongsTo(Traductor::class, 'ID_traductor', 'ID_traductores');
    }
}
