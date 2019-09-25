<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    protected $table = 'nature';
    protected $primaryKey = 'natureid';
    protected $fillable = [
        'nature','casetype','natureAvailability'
    ];
}
