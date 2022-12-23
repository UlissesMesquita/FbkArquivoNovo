<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas_Emitentes extends Model
{
        //Model referente a tabela cadastro Empresas Emitentes
        protected $primaryKey = 'id_empresa_emitente';
        public $incrementing = true;
        public $table = 'empresas__emitentes';
}
