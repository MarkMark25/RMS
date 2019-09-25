<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $table = 'vision_mission';
    protected $primaryKey = 'id';
    protected $fillable = [
        'vision','mission'
    ];
}
