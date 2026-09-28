<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    protected $primaryKey = 'ID_autores';
    protected $fillable = ['Nombre', 'Apellidos', 'telefono', 'correo', 'img_autores'];
    public $timestamps = false;

    public function libros()
    {
        return $this->hasMany(Libro::class, 'ID_autor', 'ID_autores');
    }
}
