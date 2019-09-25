<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseStatus extends Model
{
    protected $table = 'case_status';
    protected $primaryKey = 'statusid';
    protected $fillable = [
        'status'
    ];
}
