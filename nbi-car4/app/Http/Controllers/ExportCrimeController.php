<?php


namespace App\Http\Controllers;
use Excel;
use App\Exports\CrimeExport;
use DB;


use Illuminate\Http\Request;

class ExportCrimeController extends Controller
{
    function index()
    {
     return view('exportcrime');
    }
    
    public function export() 
    {
        return Excel::download(new CrimeExport, 'Terminated Crime.xlsx');
    }
}