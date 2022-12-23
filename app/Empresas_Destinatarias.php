<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas_Destinatarias extends Model
{
        //Model referente a tabela cadastro Empresas destinatarias
        protected $primaryKey = 'id_empresa_destinataria';
        public $incrementing = true;
        public $table = 'empresas__destinatarias';
        public $timestamps = false;
}
