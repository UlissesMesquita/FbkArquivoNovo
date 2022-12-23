<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $primaryKey = 'id_tp_documento';
    public $incrementing = true;
    public $table = 'tipo_documentos';
    public $timestamps = false;
}
