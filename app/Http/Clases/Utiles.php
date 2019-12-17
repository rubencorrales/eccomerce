<?php
namespace App\Http\Clases;

use Illuminate\Http\Resources\Json\JsonResource;

class Utiles extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'cargo'                 => $this->cargo,
            'empresa'               => $this->empresa,
            'ubicacion'             => $this->ubicacion,
            'tipo_contrato'         => $this->tipo_contrato,
            'mes_inicio'            => $this->mes_inicio,
            'mes_fin'               => $this->mes_fin,
            'anio_inicio_exp'       => $this->anio_inicio_exp,
            'anio_fin_exp'          => $this->anio_fin_exp,
            'fichero_experiencia'   => $this->fichero_experiencia
        ];
    }
}
