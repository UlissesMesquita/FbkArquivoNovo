<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caixa_Departamento extends Model
{
    
    //Model referente a tabela cadastro Caixa Departamento
    protected $primaryKey = ['id_caixa', 'id_departamento'];
    public $incrementing = false;
    public $table = 'caixa__departamentos';
    public $timestamps = false;


    public function departamentos() {
        return $this->hasOne('App\Departamentos', 'id_departamento'); 
    }
}