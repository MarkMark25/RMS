<?php

namespace App\Http\Controllers\admin;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use App\Cases;

class caseDeleteController extends Controller
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
        return view ('admin.caseReport');
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

        return view('admin.deleteCase',compact('cases','agent','complaintSheet','suspect','victim','nature','status','casesComplaint','dateAssigned','whenAndWhere','count'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $deleteCase = Cases::findOrFail($request->caseID);
        $caseStatus = $request['caseStatus'];
        $deleteCase->update([
            'caseAvailability'=>$caseStatus,
        ]);
        /**
        *  Concatenate description for logs.
        */
        $caseID = $request['caseID'];
        $docketnumber = $request['docketnumber'];
        $formDescription = $request['description'];
        $insertDescription = $formDescription. ' '.$docketnumber;
        Logs::create([
            'userid' => $request['userid'],
            'action' => $request['action'],
            'description' =>$insertDescription,
        ]);
        //return redirect('/caseReport')->with('alert-success', 'Successfully delete case!');
        $request->session()->flash('alert-success', 'Successfully archived case!');
        return redirect()->route('/caseReport');
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
