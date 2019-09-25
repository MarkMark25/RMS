<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'cases';
    protected $primaryKey = 'caseid';
    protected $fillable = [
        'caseid',
        'docketnumber',
        'ccn',
        'acmo',
        'complainantname',
        'complainant_Address',
        'complainant_Contact_Number',
        'dateTerminated',
        'statusid',
        'caseStatus',
        'updated_at',
        'complainant_organization',
    ];
}
