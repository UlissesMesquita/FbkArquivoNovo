<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Origens extends Model
{
            //Model referente a tabela cadastro Origens
            protected $primaryKey = 'id_origem';
            public $incrementing = true;
            public $table = 'origens';
}
