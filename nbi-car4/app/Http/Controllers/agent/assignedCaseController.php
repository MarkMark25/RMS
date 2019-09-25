<?php

namespace App\Http\Controllers\agent;
use DB; //DATABASE CONNECTION TAG
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\CaseReports;
use App\Cases;
use App\Logs;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class assignedCaseController extends Controller
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
        $id = Auth::user()->userid;
        $showData = DB::table('cases as c')
                        ->join('caseagent as ca','ca.caseid','=','c.caseid')
                        ->join('casenature as cn', 'cn.caseid','=','c.caseid')
                        ->join('nature as na','na.natureid','=','cn.natureid')
                        ->join('case_status as s','s.statusid','=','c.statusid')
                        ->join('case_suspects as cs','cs.caseid','=','c.caseid')
                        ->join('case_victims as cv','cv.caseid','=','c.caseid')
                        ->select('c.caseid','c.complainantname','c.complainant_organization','cs.*','cv.*','c.dateTerminated','s.status as stat','na.*','ca.dateassigned','c.docketNumber'
                        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (na.nature) SEPARATOR ', ') as natureName")
                        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(cs.suspect_name) SEPARATOR ', ') as suspectName")
                        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(cv.victim_name) SEPARATOR ', ') as victimName"))
                        ->where('ca.userid','=',$id)
                        ->where('c.caseAvailability','=','Available')
                        ->groupBy('c.caseid')
                        ->orderBy('ca.dateassigned','DESC')
                        ->get();

        $assignedCases = DB::table('cases as c')
                        ->join('caseagent','caseagent.caseid','=','c.caseid')
                        ->where('caseagent.userid','=',$id)
                        ->where('c.caseAvailability','=','Available')
                        ->count(DB::raw('DISTINCT c.caseid')); 

        $pendingCase = DB::table('cases as c')
                        ->join('caseagent','caseagent.caseid','=','c.caseid')
                        ->join('case_status as s','s.statusid','=','c.statusid')
                        ->where('caseagent.userid','=',$id)
                        ->where('c.caseAvailability','=','Available')
                        ->where('s.status','=','Under Investigation')
                        ->count(DB::raw('DISTINCT c.caseid'));
        

        $caseClosed = DB::table('cases as c')
                        ->join('caseagent','caseagent.caseid','=','c.caseid')
                        ->join('case_status as s','s.statusid','=','c.statusid')
                        ->where('caseagent.userid','=',$id)
                        ->where('s.status','!=','Under Investigation')
                        ->where('c.caseAvailability','=','Available')
                        ->count(DB::raw('DISTINCT c.caseid'));

        $agentFullName = DB::table('users as usr')
                        ->join('agent as agt','agt.userid','=','usr.userid')
                        ->select(DB::raw("CONCAT(agt.position, ' ', usr.firstName,' ',usr.lastName) as fname"))
                        ->where('usr.userid','=',$id)
                        ->get();

        $latestUpdate = DB::table('cases')
                        ->select(DB::raw('DATE_FORMAT(cases.updated_at, "%W % %M %d %Y %h:%i %p") as recent'))
                        ->orderBy('cases.updated_at','desc')
                        ->where('cases.caseAvailability','=','Available')
                        ->limit(1)
                        ->get();
                        
        return view('agent.assignedCase',compact('showData','assignedCases','pendingCase','caseClosed','agentFullName','latestUpdate'));
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
    public function show($id)
    {
        //
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

    public function uploadFile() {
        return view('uploadfile');
    }

   public function uploadFilePost(Request $request){
       
        $validator = Validator::make($request->all(), [
            'fileToUpload' => 'required|mimes:pdf,docx,doc|max:30000',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('alert-danger', 'Error! There were some problems with your input.');
            return redirect()->back();
        }else{
         
            $id = Auth::user()->userid;
            $agentName = DB::table('users')
              ->join('agent','agent.userid','=','users.userid')
              ->select('agent.initials', 'agent.position')
              ->where('agent.userid','=',$id)
              ->get();

            foreach ($agentName as $agentName) {
                $aInitials = $agentName->initials;
                $pos = $agentName->position;
                //$fileName = "FinalReport_".$aInitials." [".$request['docketnum']."].".request()->fileToUpload->getClientOriginalExtension();
                $fileName = "report_".$aInitials." [".$request['docketnum']."] (".date("Y-m-d h.i.s A").")".'.'.request()->fileToUpload->getClientOriginalExtension();
            }

            $report = Casereports::create([
                'report' => $fileName,
                'caseid' => $request['caseid'],
            ])->reportid;
            
            $request->fileToUpload->storeAs('agentReports',$fileName);
            
                $name = Auth::user()->lastName;
                Logs::create([
                'userid' => $id,
                'logs_caseid' => $request['caseid'],
                'action' => 'Add',
                'description' => $pos. ' '.$name. ' uploaded a report in case ' .$request['docketnum'],
            ]);
           
        
            $request->session()->flash('alert-success', 'Report succesfully uploaded.');
            return redirect()->back();
}
    }
       
}
