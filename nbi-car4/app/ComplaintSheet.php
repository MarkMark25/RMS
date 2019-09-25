<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplaintSheet extends Model
{
    protected $table = 'complaintsheet';
    protected $fillable = [
        'caseid',
        'complaintSheet',
        'place_Committed',
        'date_Committed',
        'narration_Of_Facts',
        'reported_Any_Agency',
        'status_of_Investigation',
        'where_court_Proceedings',
        'report_Considerations',
    ];
}
