<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Upload;

class Cadastro_Documentos extends Model
{

    protected $fillable = [
        
    ];

    //Model referente a tabela cadastro documentos
    protected $primaryKey = 'id_codigo';
    public $incrementing = true;
    public $table = 'cadastro__documentos';
    
    public function uploads() {
        return $this->hasMany(Upload::class, 'id_upload_codigo'); 
    }

}
