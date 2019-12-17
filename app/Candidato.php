<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{

    protected $table = 'candidatos';


    public function contactos(){

        return $this->hasMany('App\Telefono')->orderBy('id','desc');

    }
}
