<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Formacion extends Model
{
    protected $table = "formaciones";

    protected $fillable = [
        'titulacion', 'centro', 'anio_inicio', 'anio_fin', 'nota', 'actividades', 'descripcion', 'fichero', 'url', 'mostrado', 'candidatos_id'
    ];


}
