<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripcion';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
    protected $dates = ['fecha'];

    public function Estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id', 'estudiante_id');
    }

    public function Periodo()
    {
        return $this->hasOne(Periodo::class, 'id', 'periodo_id');
    }

    public function Ciclo()
    {
        return $this->hasOne(Ciclo::class, 'id', 'ciclo_id');
    }

    public function Detalle()
    {
        return $this->hasMany(InscripcionDetalle::class, 'inscripcion_id', 'id');
    }

    public function getNumeroInscripcionAttribute()
    {
        return 'I' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}
