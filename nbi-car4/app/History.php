<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $primaryKey = 'historyid';

    protected $fillable = [
        'userid','login','logout'
    ];

}
