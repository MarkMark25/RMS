<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeletedCases extends Model
{
    protected $table = 'deletedcases';
    protected $primaryKey = 'dcaseid';
    protected $fillable = [
        'complainantname','suspectname','victimname','docketnumber','ccn','acmo','dateterminated','status','natureid','agentid','dateassigned','deleted'
    ];
}
