<?php

namespace App\Http\Controllers\agent;
use DB; //DATABASE CONNECTION TAG
use File;
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class caseDataController extends Controller
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
        $casereport = DB::table('casereports')
         ->leftjoin('cases','cases.caseid','=','casereports.caseid')
         ->select('cases.caseid','casereports.report'
            ,DB::raw('DATE_FORMAT(casereports.created_at, "%W %M %d, %Y %h:%i %p") as dateUploaded'))
         ->where('cases.caseid','=',$caseid)
          ->orderBy('casereports.created_at','DESC')
         ->get();

        $showData = DB::table('nature')
        ->join('casenature','nature.natureid','=','casenature.natureid')
        ->join('cases','cases.caseid','=','casenature.caseid')
        ->join('case_status','case_status.statusid','=','cases.statusid')
        ->join('complaintsheet','complaintsheet.caseid','=','cases.caseid')
        ->select('nature.*','case_status.status as stat','complaintsheet.*','cases.*'
            ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (nature.nature) SEPARATOR ', ') as natureName")
            ,DB::raw('DATE_FORMAT(cases.dateTerminated, "%M %d %Y ") as terminated_date')
            ,DB::raw('DATE_FORMAT(cases.created_at, "%W %M %d %Y %h:%i %p") as date_created')
            ,DB::raw('DATE_FORMAT(cases.updated_at, "%W %M %d %Y %h:%i %p") as date_updated'))
        ->where('cases.caseAvailability','=','Available')
        ->where('cases.caseid','=',$caseid)
        ->get();

        $agent = DB::table('caseagent')
        ->join('cases', 'caseagent.caseid' ,'=' ,'cases.caseid')
        ->join('users' , 'users.userid', '=', 'caseagent.userid')
        ->join('agent' ,'agent.userid', '=' ,'users.userid')
        ->select(DB::raw('DATE_FORMAT(caseagent.dateassigned, "%M %d %Y ") as assigned_date')
        ,DB::raw("CONCAT(agent.position, ' ', users.firstName,' ',users.middleInitial,'. ',users.lastName) AS agentFName"),
        'caseagent.agent_status')
        ->where('cases.caseid','=',$caseid)
        ->groupBy('users.userid')
        ->orderBy('caseagent.dateassigned', 'ASC')
        ->get();

         $suspects = DB::table('case_suspects')
        ->where('caseid','=',$caseid)
        ->get();

        $victims = DB::table('case_victims')
        ->where('caseid','=',$caseid)
        ->get();

        $latestUpdate = DB::table('casereports')
                        ->join('cases', 'casereports.caseid' ,'=' ,'cases.caseid')
                        ->select(DB::raw('DATE_FORMAT(casereports.updated_at, "%W % %M %d %Y %h:%i %p") as recent'))
                        ->where('casereports.caseid','=', $caseid)
                        ->orderBy('casereports.updated_at','desc')
                        ->limit(1)
                        ->get();

        return view('agent.caseData',compact('casereport','latestUpdate','showData','agent','suspects','victims'));
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

    public function getCaseReports($agentReport) {
        $exists = Storage::disk('public')->exists('agentReports/'.$agentReport);
        if ($exists != true) {
            session()->flash('alert-danger', 'Error! File does not exist.');
            return redirect()->back();
        } else {
            $file = File::get(storage_path('app/public/agentReports/'.$agentReport));
            $mimeType = Storage::disk('public')->getMimeType('agentReports/'.$agentReport);

            $response = Response::make($file, 200);
            $response->header('Content-Type', $mimeType);
            return $response;
        }
        
    }
}
