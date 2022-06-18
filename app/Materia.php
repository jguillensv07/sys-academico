<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materia';
    protected $primaryKey = 'id';

    public function Ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id', 'id')->withDefault();
    }
    
}
