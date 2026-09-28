<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traductor extends Model
{
    protected $table = 'traductores';
    protected $primaryKey = 'ID_traductores';
    protected $fillable = ['Nombre', 'Apellidos', 'idioma_nativo', 'idiomas_traduccion', 'certificaciones', 'img_traductores'];
    public $timestamps = false;

    public function libros()
    {
        return $this->hasMany(Libro::class, 'ID_traductor', 'ID_traductores');
    }
}
