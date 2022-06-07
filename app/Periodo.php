<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table = "periodo";
    protected $primaryKey = "id";
    protected $guarded = ['id'];

    public function CicloDetalle()
    {
        return $this->hasMany(PeriodoCicloDetalle::class, 'periodo_id', 'id');
    }
}
