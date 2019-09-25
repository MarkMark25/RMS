<?php

namespace App\Http\Controllers\admin;
use DB;
use App\CaseSuspect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class advancedSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$showData = CaseSuspect::all();
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
        ,DB::raw("cases.caseid AS caseID")
        ,DB::raw("case_status.status AS caseStatus"))
        ->orderby('cases.docketnumber','ASC')
        ->where('cases.caseAvailability','=','Available')
        ->get();
        /*
        $showData = DB::table('cases')
        ->join('case_suspects','case_suspects.caseid','=','cases.caseid')
        ->join('casenature','casenature.caseid','=','cases.caseid')
        ->join('nature','nature.natureid','=','casenature.natureid')
        ->select('casenature.*','cases.*','case_suspects.*','nature.*')
        ->get();
*/
        return view ('admin.advancedSearch',compact('showData'));
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
        return view('admin.advancedSearchDetails',compact('cases','agent','complaintSheet','suspect','victim','nature','status','casesComplaint','whenAndWhere','count','casereport','latestUpdate'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $suspectAge = $request['suspectAge'];
        $suspectWeight = $request['suspectWeight'];
        $suspectHeight = $request['suspectHeight'];
        $suspectAgeTwo = $request['suspectAgeTwo'];
        $suspectWeightTwo = $request['suspectWeightTwo'];
        $suspectHeightTwo = $request['suspectHeightTwo'];

        if ($suspectAge === null && $suspectWeight === null && $suspectHeight === null) {
            $showData = CaseSuspect::all();
            return view ('admin.advancedSearch',compact('showData'));
        } else if($suspectAge != null && $suspectWeight != null && $suspectHeight != null){
            //$showData = CaseSuspect::where(DB::raw(" ('$suspectAge' BETWEEN suspect_Age AND suspect_Age2 or suspect_Age = '$suspectAge') AND ('$suspectWeight' BETWEEN weight AND weight2 or weight = '$suspectWeight') AND ('$suspectHeight' BETWEEN height AND height2 or height = '$suspectHeight')"))
            //->get();

            /**$showData = CaseSuspect::where(DB::raw(" '".$suspectAge."' BETWEEN suspect_Age and suspect_Age2 or suspect_Age = '".$suspectAge."' "))
                ->where(DB::raw(" '".$suspectWeight."' BETWEEN weight and weight2 or weight = '".$suspectWeight."' "))
                ->where(DB::raw(" '".$suspectHeight."' BETWEEN height and height2 or height = '".$suspectHeight."' "))
                ->get();
            */
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
                ,DB::raw("cases.caseid AS caseID")
                ,DB::raw("case_status.status AS caseStatus"))
                ->orderby('cases.docketnumber','ASC')
                ->where('cases.caseAvailability','=','Available')
                ->whereRaw('? between suspect_Age and suspect_Age2', [$suspectAge])
                ->whereRaw('? between weight and weight2', [$suspectWeight])
                ->whereRaw('? between height and height2', [$suspectHeight])
                ->orWhere('height', '=',$suspectHeight)
                ->orWhere('suspect_Age', '=',$suspectAge)
                ->orWhere('weight', '=',$suspectWeight)
                ->get();
                $request->flash();
            return view ('admin.advancedSearch',compact('showData'));

        } else if($suspectAge != null && $suspectWeight === null && $suspectHeight === null){
            if( $suspectAge != null && $suspectAgeTwo != null){
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
                ,DB::raw("cases.caseid AS caseID")
                ,DB::raw("case_status.status AS caseStatus"))
                ->orderby('cases.docketnumber','ASC')
                ->where('cases.caseAvailability','=','Available')
                ->where('suspect_Age','>=',$suspectAge)
                ->where('suspect_Age2','<=',$suspectAgeTwo)
                ->get();
                $request->flash();
                return view ('admin.advancedSearch',compact('showData'));
            }else{
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
                ,DB::raw("cases.caseid AS caseID")
                ,DB::raw("case_status.status AS caseStatus"))
                ->orderby('cases.docketnumber','ASC')
                ->where('cases.caseAvailability','=','Available')
                ->where('suspect_Age','=',$suspectAge)
                ->get();
                $request->flash();
                return view ('admin.advancedSearch',compact('showData'));
            }
/**
 * WORKING LEGIT
 */

/*
            $showData = CaseSuspect::whereRaw('? between suspect_Age and suspect_Age2', [$suspectAge])
            ->orWhere('suspect_Age', '=',$suspectAge)
            ->get();
*/
        } else if($suspectAge != null && $suspectWeight === null && $suspectHeight != null){
/**
 *  WORKING FU
 */
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
            ,DB::raw("cases.caseid AS caseID")
            ,DB::raw("case_status.status AS caseStatus"))
            ->orderby('cases.docketnumber','ASC')
            ->where('cases.caseAvailability','=','Available')
            ->whereRaw('? between suspect_Age and suspect_Age2', [$suspectAge])
            ->whereRaw('? between height and height2', [$suspectHeight])
            ->orWhere('height', '=',$suspectHeight)
            ->orWhere('suspect_Age', '=',$suspectAge)
            ->get();
            $request->flash();
            return view ('admin.advancedSearch',compact('showData'));
        }else if($suspectAge != null && $suspectWeight !== null && $suspectHeight === null){
/**
 *  WORKING FU
 */
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
            ,DB::raw("cases.caseid AS caseID")
            ,DB::raw("case_status.status AS caseStatus"))
            ->orderby('cases.docketnumber','ASC')
            ->where('cases.caseAvailability','=','Available')
            ->whereRaw('? between suspect_Age and suspect_Age2', [$suspectAge])
            ->whereRaw('? between weight and weight2', [$suspectWeight])
            ->orWhere('weight', '=',$suspectWeight)
            ->orWhere('suspect_Age', '=',$suspectAge)
            ->get();
            $request->flash();
            return view ('admin.advancedSearch',compact('showData'));
        }else if($suspectAge === null && $suspectWeight != null && $suspectHeight === null){
/**
 * WORKING LEGIT
 */
            if( $suspectWeight != null && $suspectWeightTwo != null){
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
                ,DB::raw("cases.caseid AS caseID")
                ,DB::raw("case_status.status AS caseStatus"))
                ->orderby('cases.docketnumber','ASC')
                ->where('cases.caseAvailability','=','Available')
                ->where('weight','>=',$suspectWeight)
                ->where('weight2','<=',$suspectWeightTwo)
                ->get();
                $request->flash();
                return view ('admin.advancedSearch',compact('showData'));
            }else{
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
                ,DB::raw("cases.caseid AS caseID")
                ,DB::raw("case_status.status AS caseStatus"))
                ->orderby('cases.docketnumber','ASC')
                ->where('cases.caseAvailability','=','Available')
                ->where('weight','=',$suspectWeight)
                ->get();
                $request->flash();
                return view ('admin.advancedSearch',compact('showData'));
            }
/*
            $showData = CaseSuspect::whereRaw('? between weight and weight2', [$suspectWeight])
            ->orWhere('weight', '=',$suspectWeight)
            ->get();

            $request->flash();
            return view ('admin.advancedSearch',compact('showData'));
*/
        }else if($suspectAge === null && $suspectWeight != null && $suspectHeight != null){
/**
 *  WORKING FU
 */
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
            ,DB::raw("cases.caseid AS caseID")
            ,DB::raw("case_status.status AS caseStatus"))
            ->orderby('cases.docketnumber','ASC')
            ->where('cases.caseAvailability','=','Available')
            ->whereRaw('? between weight and weight2', [$suspectWeight])
            ->whereRaw('? between height and height2', [$suspectHeight])
            ->orWhere('weight', '=',$suspectWeight)
            ->orWhere('height', '=',$suspectHeight)
            ->get();
            $request->flash();
            return view ('admin.advancedSearch',compact('showData'));
        }else if($suspectAge === null && $suspectWeight === null && $suspectHeight != null){
/**
 * WORKING LEGIT
 */
            if( $suspectHeight != null && $suspectHeightTwo != null){
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
                ,DB::raw("cases.caseid AS caseID")
                ,DB::raw("case_status.status AS caseStatus"))
                ->orderby('cases.docketnumber','ASC')
                ->where('cases.caseAvailability','=','Available')
                ->where('height','>=',$suspectHeight)
                ->where('height2','<=',$suspectHeightTwo)
                ->get();
                $request->flash();
                return view ('admin.advancedSearch',compact('showData'));
            }else{
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
                ,DB::raw("cases.caseid AS caseID")
                ,DB::raw("case_status.status AS caseStatus"))
                ->orderby('cases.docketnumber','ASC')
                ->where('cases.caseAvailability','=','Available')
                ->where('height','=',$suspectHeight)
                ->get();
                $request->flash();
                return view ('admin.advancedSearch',compact('showData'));
            }
            /*
            $showData = CaseSuspect::whereRaw('? between height and height2', [$suspectHeight])
            ->orWhere('height', '=',$suspectHeight)
            ->get();

            $request->flash();
            return view ('admin.advancedSearch',compact('showData'));
            */
        }



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
