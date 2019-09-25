<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'logid';
    protected $fillable = ['userid','action','description','logs_caseid'];
}
