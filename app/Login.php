<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
        //Model referente a tabela cadastro Login
        protected $primaryKey = 'id_usuario';
        public $incrementing = true;
        public $table = 'usuarios';
        public $timestamps = false;
}
