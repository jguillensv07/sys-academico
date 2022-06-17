<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscripcionDetalle extends Model
{
    protected $table = 'inscripcion_detalle';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];    

    public function Materia()
    {
        return $this->hasOne(Materia::class, 'id', 'materia_id');
    }
   
}
