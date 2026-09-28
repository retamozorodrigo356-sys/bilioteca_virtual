<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    protected $table = 'editores';
    protected $primaryKey = 'ID_editores';
    protected $fillable = ['Nombre', 'Apellidos', 'nombre_editorial', 'pais', 'img_editores'];
    public $timestamps = false;

    public function libros()
    {
        return $this->hasMany(Libro::class, 'ID_editor', 'ID_editores');
    }
}
