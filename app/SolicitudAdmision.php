<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAdmision extends Model
{
    protected $table = 'solicitud_admision';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
