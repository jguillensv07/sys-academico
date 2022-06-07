<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodoCicloDetalle extends Model
{
    protected $table = 'periodo_ciclos_detalle';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    public function Periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id', 'id')->withDefault();
    }

    public function Ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id', 'id')->withDefault();
    }
}
