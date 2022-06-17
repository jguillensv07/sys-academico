<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
    protected $dates = ['fecha_nacimiento'];

    public function getNombreCompletoAttribute()
    {
        return $this->primer_nombre . ' ' .
        $this->segundo_nombre . ' ' .
        $this->primer_apellido . ' ' .
        $this->segundo_apellido . ' ' .
        $this->apellido_casada;
    }
}
