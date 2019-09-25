<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseAgent extends Model
{
    protected $table = 'caseagent';
    protected $primaryKey = 'caseagentid';
    protected $fillable = [
        'caseid','userid','dateassigned','agent_status'
    ];
}
