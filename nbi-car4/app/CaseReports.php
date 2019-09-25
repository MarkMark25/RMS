<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Casereports extends Model
{
    protected $table = 'casereports';
    protected $primaryKey = 'reportid';
    protected $fillable = [
        'report','caseid','created_at','updated_at'
    ];
}
