<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;
use App\Cases;
use File;
use Illuminate\Support\Facades\Storage;

class caseReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('preventBackHistory'); $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($caseid)
    {
        $cases = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('cases.*','case_status.*'
        ,DB::raw("cases.caseid AS caseID")
        ,DB::raw('DATE_FORMAT(cases.dateTerminated, "%M %d %Y ") as terminated_date')
        ,DB::raw('DATE_FORMAT(cases.created_at, "%W %M %d %Y %h:%i %p") as date_created')
        ,DB::raw('DATE_FORMAT(cases.updated_at, "%W %M %d %Y %h:%i %p") as updated_Cases'))
        ->where('caseid','=',$caseid)
        ->get();

        $casereport = DB::table('casereports')
         ->leftjoin('cases','cases.caseid','=','casereports.caseid')
         ->select('cases.caseid','casereports.report',DB::raw("date(casereports.created_at) as dateUploaded"))
         ->where('cases.caseid','=',$caseid)
          ->orderBy('casereports.created_at','DESC')
         ->get();

        $casesComplaint = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('cases.*','case_status.*'
        ,DB::raw("cases.caseid AS caseID"))
        ->where('caseid','=',$caseid)
        ->get();

        $agent = DB::table('caseagent')
        ->join('cases', 'caseagent.caseid' ,'=' ,'cases.caseid')
        ->join('users' , 'users.userid', '=', 'caseagent.userid')
        ->join('agent' ,'agent.userid', '=' ,'users.userid')
        ->select('cases.*','caseagent.*','agent.*'
            ,DB::raw('DATE_FORMAT(caseagent.dateassigned, "%M %d %Y ") as assigned_date')
            ,DB::raw("CONCAT(agent.position, ' ' ,users.firstName,' ',users.middleInitial,'. ',users.lastName) AS agentName"))
        ->where('cases.caseid','=',$caseid)
        ->groupBy('users.userid')
        ->orderBy('caseagent.dateassigned','ASC')
        ->get();


        $complaintSheet = DB::table('complaintSheet')
        ->rightJoin('cases','cases.caseid','=','complaintSheet.caseid')
        ->select('cases.*','complaintSheet.*')
        ->where('complaintSheet.caseid','=',$caseid)
        ->get();

        $count = DB::table('cases')
        ->leftJoin('complaintSheet','cases.caseid','=','complaintSheet.caseid')
        ->select('cases.*','complaintSheet.*')
        ->where('complaintSheet.caseid','=',$caseid)
        ->count();

        $whenAndWhere = DB::table('complaintSheet')
        ->rightJoin('cases','cases.caseid','=','complaintSheet.caseid')
        ->select('cases.*','complaintSheet.*')
        ->where('complaintSheet.caseid','=',$caseid)
        ->get();

        $suspect = DB::table('case_suspects')
        ->where('caseid','=',$caseid)
        ->get();

        $victim = DB::table('case_victims')
        ->where('caseid','=',$caseid)
        ->get();

        $nature = DB::table('cases')
        ->join('casenature' ,'casenature.caseid', '=' ,'cases.caseid')
        ->join('nature' ,'nature.natureid', '=' ,'casenature.natureid')
        ->select('cases.*','casenature.*','nature.*',DB::raw("GROUP_CONCAT(DISTINCT CONCAT (nature.nature) SEPARATOR ', ') as natureName"))
        ->where('cases.caseid','=',$caseid)
        ->get();

        $status = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('case_status.*','cases.*')
        ->where('cases.caseid','=',$caseid)
        ->get();

        $latestUpdate = DB::table('casereports')
                        ->join('cases', 'casereports.caseid' ,'=' ,'cases.caseid')
                        ->select(DB::raw('DATE_FORMAT(casereports.updated_at, "%W % %M %d %Y %h:%i %p") as recent'))
                        ->where('casereports.caseid','=', $caseid)
                        ->orderBy('casereports.updated_at','desc')
                        ->limit(1)
                        ->get();
        return view('admin.caseReview',compact('cases','agent','complaintSheet','suspect','victim','nature','status','casesComplaint','whenAndWhere','count','casereport','latestUpdate'));

    }
    public function showCase($caseid)
    {
        $cases = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('cases.*','case_status.*'
        ,DB::raw("cases.caseid AS caseID")
        ,DB::raw("cases.updated_at AS updated_Cases"))
        ->where('caseid','=',$caseid)
        ->get();

        $casereport = DB::table('casereports')
         ->leftjoin('cases','cases.caseid','=','casereports.caseid')
         ->select('cases.caseid','casereports.report',DB::raw("date(casereports.created_at) as dateUploaded"))
         ->where('cases.caseid','=',$caseid)
          ->orderBy('casereports.created_at','DESC')
         ->get();

        $casesComplaint = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('cases.*','case_status.*'
        ,DB::raw("cases.caseid AS caseID"))
        ->where('caseid','=',$caseid)
        ->get();

        $agent = DB::table('caseagent')
        ->join('cases', 'caseagent.caseid' ,'=' ,'cases.caseid')
        ->join('users' , 'users.userid', '=', 'caseagent.userid')
        ->join('agent' ,'agent.userid', '=' ,'users.userid')
        ->select('cases.*','caseagent.*','agent.*'
        ,DB::raw("CONCAT(users.firstName,' ',users.middleInitial,'. ',users.lastName,' ',agent.position) AS agentName"))
        ->where('cases.caseid','=',$caseid)
        ->groupBy('users.userid')
        ->orderBy('caseagent.dateassigned','ASC')
        ->get();


        $complaintSheet = DB::table('complaintSheet')
        ->rightJoin('cases','cases.caseid','=','complaintSheet.caseid')
        ->select('cases.*','complaintSheet.*')
        ->where('complaintSheet.caseid','=',$caseid)
        ->get();

        $count = DB::table('cases')
        ->leftJoin('complaintSheet','cases.caseid','=','complaintSheet.caseid')
        ->select('cases.*','complaintSheet.*')
        ->where('complaintSheet.caseid','=',$caseid)
        ->count();

        $whenAndWhere = DB::table('complaintSheet')
        ->rightJoin('cases','cases.caseid','=','complaintSheet.caseid')
        ->select('cases.*','complaintSheet.*')
        ->where('complaintSheet.caseid','=',$caseid)
        ->get();

        $suspect = DB::table('case_suspects')
        ->where('caseid','=',$caseid)
        ->get();

        $victim = DB::table('case_victims')
        ->where('caseid','=',$caseid)
        ->get();

        $nature = DB::table('cases')
        ->join('casenature' ,'casenature.caseid', '=' ,'cases.caseid')
        ->join('nature' ,'nature.natureid', '=' ,'casenature.natureid')
        ->select('cases.*','casenature.*','nature.*')
        ->where('cases.caseid','=',$caseid)
        ->get();

        $status = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('case_status.*','cases.*')
        ->where('cases.caseid','=',$caseid)
        ->get();

        $latestUpdate = DB::table('casereports')
                        ->join('cases', 'casereports.caseid' ,'=' ,'cases.caseid')
                        ->select(DB::raw('DATE_FORMAT(casereports.updated_at, "%W % %M %d %Y %h:%i %p") as recent'))
                        ->where('casereports.caseid','=', $caseid)
                        ->orderBy('casereports.updated_at','desc')
                        ->limit(1)
                        ->get();
        return view('admin.viewCase',compact('cases','agent','complaintSheet','suspect','victim','nature','status','casesComplaint','whenAndWhere','count','casereport','latestUpdate'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getCaseReport($report) {
        $exists = Storage::disk('public')->exists('agentReports/'.$report);
        if ($exists != true) {
            session()->flash('alert-danger', 'Error! File does not exist.');
            return redirect()->back();
        } else {
            $file = File::get(storage_path('app/public/agentReports/'.$report));
            $mimeType = Storage::disk('public')->getMimeType('agentReports/'.$report);

            $response = Response::make($file, 200);
            $response->header('Content-Type', $mimeType);
            return $response;
        }

    }
}
