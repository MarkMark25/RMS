<?php

namespace App\Http\Controllers\admin;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\addNewCase;
use App\Cases;
use App\Logs;
use App\Nature;
use App\Users;
use App\CaseAgent;
use App\CaseNature;
use App\CaseSuspect;
use App\CaseVictims;
use App\ComplaintSheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class archivedRecordsController extends Controller
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
        $agent = DB::table('users')
        ->where('role','=','Agent')
        ->get();
        $agent2 = DB::table('users')
        ->where('role','=','Agent')
        ->get();
        $nature = DB::table('nature')
        ->where('natureAvailability','=','Available')
        ->get();
        $nature2 = DB::table('nature')
        ->where('natureAvailability','=','Available')
        ->get();
        $status = DB::table('case_status')
        ->get();
        $showData = DB::table('nature')
        ->join('casenature','nature.natureid','=','casenature.natureid')
        ->join('caseagent','casenature.caseid','=','caseagent.caseid')
        ->join('users','users.userid','=','caseagent.userid')
        ->join('cases','caseagent.caseid','=','cases.caseid')
        ->leftJoin('complaintsheet','complaintsheet.caseid','=','cases.caseid')
        ->join('agent','caseagent.userid','=','agent.userid')
        ->join('case_suspects','case_suspects.caseid','=','cases.caseid')
        ->join('case_status','case_status.statusid','=','cases.statusid')
        ->join('case_victims','case_victims.caseid','=','cases.caseid')
        ->select('nature.*','case_status.*','caseagent.*','users.*','agent.*','cases.*','case_suspects.*','case_victims.*', 'complaintsheet.*'
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (agent.position, ' ', users.firstName,' ',users.lastName) SEPARATOR ' and ') as full_name")
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (nature.nature) SEPARATOR ' and ') as natureName")
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(case_suspects.suspect_name) SEPARATOR ' and ') as suspectName")
        ,DB::raw("cases.caseid AS caseID")
        ,DB::raw("case_status.status AS caseStatus")
        ,DB::raw("CONCAT(users.firstName,' ',users.middleInitial,'. ',users.lastName,' ',agent.position) AS agentName"))
        ->groupBy(DB::raw('caseagent.caseid'),
        DB::raw('case_victims.caseid'),
        DB::raw('case_suspects.caseid'))
        ->orderby('cases.docketnumber','ASC')
        ->where('cases.caseAvailability','!=','Available')
        ->get();
        return view ('admin.archivedRecords',compact('showData','agent','nature','status','agent2','nature2'));
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
        ,DB::raw("cases.caseid AS caseID"))
        ->where('caseid','=',$caseid)
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

        return view('admin.moreDetails',compact('cases','agent','complaintSheet','suspect','victim','nature','status','casesComplaint','whenAndWhere','count'));
    }
    public function showcase($caseid){
        $cases = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('cases.*','case_status.*'
        ,DB::raw("cases.caseid AS caseID"))
        ->where('caseid','=',$caseid)
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
        $dateAssigned = DB::table('caseagent')
        ->join('cases', 'caseagent.caseid' ,'=' ,'cases.caseid')
        ->join('users' , 'users.userid', '=', 'caseagent.userid')
        ->join('agent' ,'agent.userid', '=' ,'users.userid')
        ->select('cases.*','caseagent.*','agent.*'
        ,DB::raw("CONCAT(users.firstName,' ',users.middleInitial,'. ',users.lastName,' ',agent.position) AS agentName"))
        ->where('cases.caseid','=',$caseid)
        ->groupBy('cases.caseid')
        ->get();
        $complaintSheet = DB::table('complaintsheet')
        ->rightJoin('cases','cases.caseid','=','complaintsheet.caseid')
        ->select('cases.*','complaintsheet.*')
        ->where('complaintsheet.caseid','=',$caseid)
        ->get();
        $count = DB::table('cases')
        ->leftJoin('complaintsheet','cases.caseid','=','complaintsheet.caseid')
        ->select('cases.*','complaintsheet.*')
        ->where('complaintsheet.caseid','=',$caseid)
        ->count();
        $whenAndWhere = DB::table('complaintsheet')
        ->rightJoin('cases','cases.caseid','=','complaintsheet.caseid')
        ->select('cases.*','complaintsheet.*')
        ->where('complaintsheet.caseid','=',$caseid)
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
        return view('admin.unArchivedCases',compact('cases','agent','complaintSheet','suspect','victim','nature','status','casesComplaint','dateAssigned','whenAndWhere','count'));
    }

    public function delete(Request $request)
    {
        if($request==true){
            $caseStatus = $request['caseAvailability'];
            $caseID = $request['caseID'];
            DB::update('update cases set caseAvailability = ? where caseid = ?',[$caseStatus,$caseID]);
            /**
            *  Concatenate description for logs.
            */
            $docketnumber = $request['docketnumber'];
            $formDescription = $request['descriptionOne'];
            $insertDescription = $formDescription. ' '.$docketnumber;
            Logs::create([
                'userid' => $request['userid'],
                'action' => $request['action'],
                'description' =>$insertDescription,
            ]);
            return redirect('/archivedRecords')->with('alert-success', 'Successfully unarchived the case!');
            return redirect()->back();
        }else{
            return redirect('/archivedRecords')->with('alert-danger', 'ERROR!');
            return redirect()->back();
        }
        /*
        if($request==true){
            $deleteCase = Cases::find($request->caseID);
            $caseStatus = $request['caseAvailability'];
            $deleteCase->update([
                'caseAvailability'=>$caseStatus,
            ]);
            $caseID = $request['caseID'];
            $formDescription = $request['description'];
            $insertDescription = $formDescription. ' '.$caseID;
            Logs::create([
                'userid' => $request['userid'],
                'action' => $request['action'],
                'description' =>$insertDescription,
            ]);
            return redirect('/caseReport')->with('alert-success', 'Successfully delete case!');
            //$request->session()->flash('alert-success', 'Successfully delete case!');
            //return redirect()->route('/caseReport');
            //return redirect()->back();
        }else{
            return redirect('/caseReport')->with('alert-danger', 'ERROR!');
        }
        */
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
}
