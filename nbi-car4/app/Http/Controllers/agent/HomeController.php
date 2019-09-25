<?php

namespace App\Http\Controllers\agent;
use DB; //DATABASE CONNECTION TAG
use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
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
        $showData = DB::table('nature')
        ->join('casenature','nature.natureid','=','casenature.natureid')
        ->join('caseagent','casenature.caseid','=','caseagent.caseid')
        ->join('users','users.userid','=','caseagent.userid')
        ->join('cases','caseagent.caseid','=','cases.caseid')
        ->join('agent','caseagent.userid','=','agent.userid')
        ->join('case_suspects','case_suspects.caseid','=','cases.caseid')
        ->join('case_status','case_status.statusid','=','cases.statusid')
        ->join('case_victims','case_victims.caseid','=','cases.caseid')
        ->select('nature.*','case_status.status as stat','caseagent.*','users.*','agent.*','cases.*','case_suspects.*','case_victims.*'
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (agent.position, ' ', users.firstName,' ',users.lastName) SEPARATOR ', ') as full_name")
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (nature.nature) SEPARATOR ', ') as natureName")
        ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT(case_suspects.suspect_name) SEPARATOR ', ') as suspectName"))
        ->where('cases.caseAvailability','=','Available')
        ->groupBy('cases.caseid')
        ->orderBy('cases.caseid','DESC')
        ->get();

         $latestUpdate = DB::table('cases')
                        ->select(DB::raw('DATE_FORMAT(cases.updated_at, "%W % %M %d %Y %h:%i %p") as recent'))
                        ->orderBy('cases.updated_at','desc')
                        ->limit(1)
                        ->get();


         return view('agent.home',compact('showData','latestUpdate'));
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
