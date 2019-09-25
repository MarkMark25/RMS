<?php

namespace App\Exports;

use App\Crime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use DB;

class CrimeExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        /*$this->f_date = $request->input('from_date'); 
        $this->t_date = $request->input('to_date'); */
        $showData = DB::table('cases as c')
        ->join('caseagent as ca', 'ca.caseid', '=', 'c.caseid')
        ->join('casenature as cn', 'cn.caseid', '=', 'c.caseid')
        ->join('nature as na', 'na.natureid', '=', 'cn.natureid')
        ->join('case_status as s', 's.statusid', '=', 'c.statusid')
        ->join('case_suspects as cs', 'cs.caseid', '=', 'c.caseid')
        ->join('case_victims as cv', 'cv.caseid', '=', 'c.caseid')
        ->join('users as usr', 'usr.userid', '=','ca.userid')
        ->join('agent as agt', 'agt.userid', '=', 'usr.userid')
        ->select('c.caseid'
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(c.ccn, '\n',c.acmo) SEPARATOR '\n') as ccnacmo")
                ,'c.docketnumber'
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (UPPER(na.nature)) SEPARATOR ' \n ') as case_nature")
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(UPPER(c.complainantname), ', ',cv.victim_name) SEPARATOR ', ') as comvic") 
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (UPPER(cs.suspect_name)) SEPARATOR ' , ') as subject") 
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (ca.dateAssigned) SEPARATOR ' \n ') as assigneddate")
                ,'c.dateTerminated'         
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(agt.position, ' ',usr.lastName) SEPARATOR '\n') as agentoncase")           
                ,'s.status')
                ->where('s.status', '!=', "Under Investigation")
                #->whereBetween('ca.dateAssigned', array($this->f_date, $this->t_date))
                ->groupBy('c.caseid')
                ->orderBy('ca.dateAssigned','DESC')
            ->get();
        #->where('caseStatus', '!=', "Under Investigation")->get();
        return $showData;
    }
    

    public function headings(): array
    {
        return [[' ',' ', ' ', ' ', ' ', 'DEPARTMENT OF JUSTICE'], 
        [' ',' ', ' ', ' ', ' ', 'NATIONAL BUREAU OF INVESTIGATION'],
        [' ',' ', ' ', ' ', ' ', 'DETAILED REPORT OF RECEIVED AND TERMINATED CRIME CASES FOR _____________'],
        [
            'No.',
            'NBI CCN No./ACMO NO.',
            'CAR No.',
            'Nature',
            'Complainant/Victim',
            'Subject/s',
            'Date Assigned',
            'Date Terminated',
            'Agent-on-Case',           
            'Status'
        ]];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
               
            },
        ];
    }

}
