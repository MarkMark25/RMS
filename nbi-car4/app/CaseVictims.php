<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseVictims extends Model
{
    protected $table = 'case_victims';
    protected $primaryKey = 'id';
    protected $fillable = [
        'caseid','victim_name','victim_Address','victim_Contact_Number','victim_Sex','victim_Age','victim_Civil_Status','victim_Occupation',
    ];
}
