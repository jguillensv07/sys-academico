<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodoCicloDetalleMateria extends Model
{
    protected $table = 'periodo_ciclos_detalle_materia';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function Periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id', 'id')->withDefault();
    }

    public function Ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id', 'id')->withDefault();
    }

    public function Materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'id')->withDefault();
    }

    public function Docente()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'id')->withDefault();
    }
}
