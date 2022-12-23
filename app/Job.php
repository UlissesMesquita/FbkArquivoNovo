<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = 'id_job';
    public $incrementing = true;
    public $table = 'jobs';
    public $timestamps = false;
}
