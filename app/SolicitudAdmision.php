<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAdmision extends Model
{
    protected $table = 'solicitud_admision';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
    protected $dates = ['fecha_solicitud'];

    public function Estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id', 'estudiante_id');
    }
}
