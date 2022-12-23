<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesquisas extends Model
{
            //Model referente a tabela cadastro Origens
            protected $primaryKey = 'id_codigo';
            public $incrementing = true;
            public $table = 'cadastro__documentos';
}
