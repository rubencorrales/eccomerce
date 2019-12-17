<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experiencia extends Model
{
    protected $table = "experiencias";

    protected $fillable = [
        'candidatos_id', 'empresa', 'ubicacion', 'puesto', 'tipo_contrato', 'mes_comienza', 'anio_comienza', 'mes_termina',
        'anio_termina', 'puesto_actual', 'titular', 'descripcion', 'url', 'fichero', 'mostrado', 'created_at', 'updated_at'
    ];

}
