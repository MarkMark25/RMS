<?php

namespace App\Http\Controllers\encoder;

use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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
use App\CaseStatus;
use Carbon\Carbon;

class updateController extends Controller
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
        ->where('cases.caseAvailability','=','Available')
        ->where('case_status.status','=','Under Investigation')
        ->get();
        return view ('encoder.caseRecords',compact('showData','agent','nature','status','agent2','nature2', 'sample'));
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
    public function show(Request $request, $caseid)
    {
        $cases = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('cases.*','case_status.*'
        ,DB::raw("cases.caseid AS caseID"))
        ->where('caseid','=',$caseid)
        ->get();
        $dateTerminated = DB::table('cases')
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

        $agentID = $request['readME'];

        $agent2 = DB::table('caseagent')
        ->join('cases', 'caseagent.caseid' ,'=' ,'cases.caseid')
        ->join('users' , 'users.userid', '=', 'caseagent.userid')
        ->join('agent' ,'agent.userid', '=' ,'users.userid')
        ->select('cases.*','caseagent.*','agent.*',
        DB::raw("CONCAT(users.firstName,' ',users.middleInitial,'. ',users.lastName,' ',agent.position) AS agentName"))
        ->where('role','=','Investigator')
        ->where('userStatus','=','Active')
        ->where('users.userid','!=',$agentID)
        ->groupBy('users.userid')
        ->get();
        /*
        $agent2 = DB::table('users')
        ->join('agent' ,'agent.userid', '=' ,'users.userid')
        ->select('users.*','agent.*',
        DB::raw("CONCAT(users.firstName,' ',users.middleInitial,'. ',users.lastName,' ',agent.position) AS agentName"))
        ->where('role','=','Investigator')
        ->where('userStatus','=','Active')
        ->get();
*/
        $dateAssigned = DB::table('caseagent')
        ->join('cases', 'caseagent.caseid' ,'=' ,'cases.caseid')
        ->join('users' , 'users.userid', '=', 'caseagent.userid')
        ->join('agent' ,'agent.userid', '=' ,'users.userid')
        ->select('cases.*','caseagent.*','agent.*'
        ,DB::raw("CONCAT(users.firstName,' ',users.middleInitial,'. ',users.lastName,' ',agent.position) AS agentName"))
        ->where('cases.caseid','=',$caseid)
        ->groupBy('cases.caseid')
        ->get();
        $complaintSheet = DB::table('cases')
        ->leftJoin('complaintsheet','cases.caseid','=','complaintsheet.caseid')
        ->select('cases.*','complaintsheet.*')
        ->where('complaintsheet.caseid','=',$caseid)
        ->get();
        $whenAndWhere = DB::table('cases')
        ->leftJoin('complaintsheet','cases.caseid','=','complaintsheet.caseid')
        ->select('cases.*','complaintsheet.*')
        ->where('complaintsheet.caseid','=',$caseid)
        ->get();
        $count = DB::table('cases')
        ->leftJoin('complaintsheet','cases.caseid','=','complaintsheet.caseid')
        ->select('cases.*','complaintsheet.*')
        ->where('complaintsheet.caseid','=',$caseid)
        ->count();
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
        ->groupBy('casenature.natureid')
        ->get();
        $status = DB::table('cases')
        ->join('case_status', 'case_status.statusid', '=' ,'cases.statusid')
        ->select('case_status.*','cases.*')
        ->where('cases.caseid','=',$caseid)
        ->get();
        $statusAll = DB::table('case_status')
        ->get();
        $nature2 = DB::table('nature')
        ->where('natureAvailability','=','Available')
        ->get();
        return view('encoder.updateRecords',compact('cases','agent','complaintSheet','suspect','victim','nature','status','casesComplaint','dateAssigned','whenAndWhere','dateTerminated','agent2','count','statusAll','nature2'));
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ccn' => 'nullable|max:255',
            'docketnumber' => 'required|max:255',
            'acmo' => 'nullable|max:255',

            'complainant_Address' => 'nullable|max:255',
            'complainant_Contact_Number' => 'nullable|max:255',
            'place_Committed' => 'nullable|max:255',
            'date_Committed' => 'nullable|max:255',
            'narration_Of_Facts' => 'nullable|max:255',
            'reported_Any_Agency' => 'nullable|max:255',
            'status_of_Investigation' => 'nullable|max:255',
            'where_court_Proceedings' => 'nullable|max:255',
            'report_Considerations' => 'nullable|max:255',
            'suspect_Address'=> 'nullable|max:255',
            'suspect_Contact_Number'=> 'nullable|max:255',
            'suspect_Sex'=> 'nullable|max:255',
            'suspect_Age'=> 'nullable|max:255',
            'suspect_Civil_Status'=> 'nullable|max:255',
            'suspect_Occupation'=> 'nullable|max:255',
            'victim_Address' => 'nullable|max:255',
            'victim_Contact_Number' => 'nullable|max:255',
            'victim_Sex' => 'nullable|max:255',
            'victim_Age' => 'nullable|max:255',
            'victim_Civil_Status' => 'nullable|max:255',
            'victim_Occupation' => 'nullable|max:255',
        ]);
        if ($validator->fails()){
            return redirect('/caseReport')->withErrors($validator)->withInput();
        }else {
            $caseStatusID = DB::table('case_status')
            ->select('status')
            ->where('statusid','=', $request->status)
            ->get();
            $caseStatus = CaseStatus::find($request->status)->status;
            //return $caseStatus;
            if($request->dateTerminated == null && $caseStatus != "Under Investigation"){
                return redirect()->back() ->with('alert', 'You must provide the date of termination in order to change the status.');
            }else if(($request->ccn == null || $request->acmo == null ) && $caseStatus != "Under Investigation"){
                return redirect()->back() ->with('alert', 'ACMO and CCN number is required in order to change the Case status.');
            }else {
                //$countNature = count((array)$request->caseNatureID);
                /*
                $natureArray = array($request['caseNatureID']);
                $countMeNature = count($natureArray);
                //Delete Case Nature
                if($countMeNature>1){
                    //DB::delete('delete from casenature where cnatureid IN (?)', [$natureArray]);
                    CaseNature::whereIn('cnatureid',$natureArray)->delete();
                }else{
                    //DB::delete('delete from casenature where cnatureid = ?', [$natureArray]);
                    CaseNature::where('cnatureid', $natureArray)->delete();
                }
                */
                /*
                //Case nature delete
                if(count($request->caseNatureID)>0) {
                    foreach($request->caseNatureID as $item => $v){
                        $data3 = array(
                            'cnatureid' => $request->caseNatureID[$item],
                        );
                        CaseNature::deleted($data3);
                    }
                }
                */

                /**Delete Suspect
                 *$countSuspect = count($request->suspectID);
                *if ($countSuspect==1) {
                *   CaseSuspect::where('id',$request->suspectID)->delete();
                *} else {
                *    CaseSuspect::whereIn('id',$request->suspectID)->delete();
                *}
                */

                $countAgent = count($request->agentCaseID);
                /**
                 * /Delete Victims
                 * $countVictims = count($request->victimID);
                 * if ($countVictims==1) {
                 * CaseVictims::where('id',$request->victimID)->delete();
                 * } else {
                 * CaseVictims::whereIn('id',$request->victimID)->delete();
                 * }
                 *
                 */

                /*Delete Agent
                if ($countAgent==1) {
                    CaseAgent::where('caseagentid',$request->agentCaseID)->delete();
                } else {
                    CaseAgent::whereIn('caseagentid',$request->agentCaseID)->delete();
                }
                */
                //Cases Update
                $casesID = $request['caseID'];
                $caseNaturaCaseID = CaseNature::where('caseid','=',$request->caseID);
                $caseNaturaCaseID->delete();

                $caseSuspectCaseID = CaseSuspect::where('caseid','=',$request->caseID);
                $caseSuspectCaseID->delete();

                $caseVictimCaseID = CaseVictims::where('caseid','=',$request->caseID);
                $caseVictimCaseID->delete();

                $caseAgentCaseID = CaseAgent::where('caseid','=',$request->caseID);
                $caseAgentCaseID->delete();

                $cases = Cases::findOrFail($request->caseID);
                $cases->update([
                    'docketnumber' => $request['docketnumber'],
                    'ccn' => $request['ccn'],
                    'acmo' => $request['acmo'],
                    'complainantname' => $request['complainant'],
                    'dateTerminated' =>  $request['dateTerminated'],
                    'statusid' => $request['status'],
                    'complainant_Address' => $request['complainantAddress'],
                    'complainant_organization' => $request['complainantOrganization'],
                    'complainant_Contact_Number' => $request['complainantTelNumber'],
                    //Added data
                    'updated_at' => Carbon::now(),
                ]);
                /*
                Agent update date assigned
                $dateAssigned = Caseagent::findOrFail($request->datecaseID);
                $dateAssigned->update([
                    'dateassigned' => $request['dateAssigned'],
                ]);
                */
                //Case Agent store agent and dates
                $dateAgentAssigned = $request['dateAssigned'];
                if(count($request->fld_val2)>0) {
                    foreach($request->fld_val2 as $item => $v){
                        $data2 = array(
                            'caseid' => $casesID,
                            'userid' => $request->fld_val2[$item],
                            'dateassigned'=> $request->dateAssigned[$item],
                            'agent_status'=> $request->agentStatus[$item],
                        );
                        CaseAgent::create($data2);
                    }
                }
                //Complaint Sheet Update
                $complainSheet = ComplaintSheet::findOrFail($request->complainSheetID);
                $complainSheet->update([
                        'caseid' => $casesID,
                        'place_Committed' => $request['whereCommitted'],
                        'date_Committed' => $request['whenCommitted'],
                        'narration_Of_Facts' => $request['narrationOfFacts'],
                        'reported_Any_Agency' => $request['hasTheMatter'],
                        'status_of_Investigation' => $request['statusOfInvestigation'],
                        'where_court_Proceedings' => $request['isTheMatterComplained'],
                        'report_Considerations' => $request['whatConsidirations'],
                    ]);
                //Case nature store
                if(count($request->fld_val1)>0) {
                    foreach($request->fld_val1 as $item => $v){
                        $data3 = array(
                            'caseid' => $casesID,
                            'natureid' => $request->fld_val1[$item],
                        );
                        CaseNature::create($data3);
                    }
                }
                //Suspect name store
                if(count($request->suspectNameA)>0) {
                    foreach($request->suspectNameA as $item => $v){
                        $data4 = array(
                            'caseid' => $casesID,
                            'suspect_name' => $request->suspectNameA[$item],
                            'suspect_Address'=> $request->suspectAddressA[$item],
                            'suspect_Contact_Number'=> $request->suspectTelNumberA[$item],
                            'suspect_Sex'=> $request->suspectSexA[$item],
                            'suspect_Age'=> $request->suspectAgeA[$item],
                            'suspect_Civil_Status'=> $request->suspectCivilStatusA[$item],
                            'suspect_Occupation'=> $request->suspectOccupationA[$item],
                            'status'=> $request->statusA[$item],
                            'height' => $request->suspectHeightA[$item],
                            'weight' => $request->suspectWeightA[$item],
                            'eye_color' => $request->suspectEyeColorA[$item],
                            'hair_color' => $request->suspectHairColorA[$item],
                            'skin_tone' => $request->suspectSkinToneA[$item],
                            //ADD DATA
                            'suspect_Age2'=> $request->suspectAgeTwo[$item],
                            'height2' => $request->suspectHeightTwo[$item],
                            'weight2' => $request->suspectWeightTwo[$item],
                        );
                        CaseSuspect::create($data4);
                    }
                }
                //Victim name store
                if(count($request->victimNameA)>0) {
                    foreach($request->victimNameA as $item => $v){
                        $data5 = array(
                            'caseid' => $casesID,
                            'victim_name' => $request->victimNameA[$item],
                            'victim_Address' => $request->victimAddressA[$item],
                            'victim_Contact_Number' => $request->victimTelNumberA[$item],
                            'victim_Sex' => $request->victimSexA[$item],
                            'victim_Age' => $request->victimAgeA[$item],
                            'victim_Civil_Status' => $request->victimCivilStatusA[$item],
                            'victim_Occupation' => $request->victimOccupationA[$item],
                        );
                        CaseVictims::create($data5);
                    }
                }
                //Activity Logs create
                $docketnumber = $request['docketnumber'];
                $formDescription = $request['description'];
                $insertDescription = $formDescription. ' '.$docketnumber;
                Logs::create([
                    'userid' => $request['userid'],
                    'action' => $request['action'],
                    'description' => $insertDescription,
                ]);

                return redirect('/caseRecords')->with('alert-success', 'Successfully update the case!');
            }
        }
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
