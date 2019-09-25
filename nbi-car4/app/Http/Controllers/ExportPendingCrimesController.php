<?php


namespace App\Http\Controllers;
use Excel;
use App\Exports\PendingCrimeExport;
use DB;


use Illuminate\Http\Request;

class ExportPendingCrimesController extends Controller
{
    function index()
    {       
     return view('exportcrime');
    }
    
    public function export() 
    {      
        return Excel::download(new PendingCrimeExport, 'Pending Crime.xlsx');
    }
}