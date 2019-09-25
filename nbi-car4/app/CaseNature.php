<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseNature extends Model
{
    protected $table = 'casenature';
    protected $primaryKey = 'cnatureid';
    protected $fillable = [
        'caseid', 'natureid'
    ];
}
