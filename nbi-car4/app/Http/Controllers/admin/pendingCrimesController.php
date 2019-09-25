<?php

namespace App\Http\Controllers\admin;
use DB; //DATABASE CONNECTION TAG
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\ValidationException;


class pendingCrimesController extends Controller 
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
        $showData = DB::table('cases as c')
        ->join('caseagent as ca', 'ca.caseid', '=', 'c.caseid')
        ->join('casenature as cn', 'cn.caseid', '=', 'c.caseid')
        ->join('nature as na', 'na.natureid', '=', 'cn.natureid')
        ->join('case_status as s', 's.statusid', '=', 'c.statusid')
        ->join('case_suspects as cs', 'cs.caseid', '=', 'c.caseid')
        ->join('case_victims as cv', 'cv.caseid', '=', 'c.caseid')
        ->join('users as usr', 'usr.userid', '=','ca.userid')
        ->join('agent as agt', 'agt.userid', '=', 'usr.userid')
        ->select('c.caseid',DB::raw('upper(s.status) as stat'),'c.docketnumber'
                ,'c.complainant_organization'
                ,DB::raw('upper(c.complainant_organization) as comOrg')
                ,DB::raw('upper(c.complainantname) as com')
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (cv.victim_name) SEPARATOR ', ')) as vic")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(c.ccn, '\n',c.acmo) SEPARATOR '\n')) as ccnacmo")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(agt.position, ' ',usr.lastName) SEPARATOR '\n')) as agentoncase")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (cs.suspect_name) SEPARATOR ' \n ')) as subject")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (na.nature) SEPARATOR ' \n ')) as case_nature")
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (DATE_FORMAT(ca.dateassigned, '%m/%d/%Y')) SEPARATOR ' \n ') as assigneddate"))
                ->where('s.status', '=', "Under Investigation")
                ->where('c.caseAvailability','=','Available')
                ->groupBy('c.caseid')
                ->orderBy('ca.dateAssigned','DESC')
            ->get();
            $cMonth = null;
            $year = null;
        #->where('caseStatus', '=', "Under Investigation")->get();
        return view('admin.pendingCrimes',compact('showData', 'cMonth', 'year'));
    }

   



   
public function date_filter(Request $request){
    $validator = Validator::make($request->all(), [
        'year' => 'required',
        'month' => 'required'
    ]);

    if ($validator->fails()){
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }else {
    $year = $request->input('year'); 
    $month = $request->input('month');

    $showData = DB::table('cases as c')
        ->join('caseagent as ca', 'ca.caseid', '=', 'c.caseid')
        ->join('casenature as cn', 'cn.caseid', '=', 'c.caseid')
        ->join('nature as na', 'na.natureid', '=', 'cn.natureid')
        ->join('case_status as s', 's.statusid', '=', 'c.statusid')
        ->join('case_suspects as cs', 'cs.caseid', '=', 'c.caseid')
        ->join('case_victims as cv', 'cv.caseid', '=', 'c.caseid')
        ->join('users as usr', 'usr.userid', '=','ca.userid')
        ->join('agent as agt', 'agt.userid', '=', 'usr.userid')
        ->select('c.caseid',DB::raw('upper(s.status) as stat'),'c.docketnumber'
                ,'c.complainant_organization'
                ,DB::raw('upper(c.complainant_organization) as comOrg')
                ,DB::raw('upper(c.complainantname) as com')
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (cv.victim_name) SEPARATOR ', ')) as vic")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(c.ccn, '\n',c.acmo) SEPARATOR '\n')) as ccnacmo")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT(agt.position, ' ',usr.lastName) SEPARATOR '\n')) as agentoncase")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (cs.suspect_name) SEPARATOR ' \n ')) as subject")
                ,DB::raw("upper(GROUP_CONCAT(DISTINCT CONCAT (na.nature) SEPARATOR ' \n ')) as case_nature")
                ,DB::raw("GROUP_CONCAT(DISTINCT CONCAT (DATE_FORMAT(ca.dateassigned, '%m/%d/%Y')) SEPARATOR ' \n ') as assigneddate"))
                ->where('s.status', '=', "Under Investigation")
                ->where('c.caseAvailability','=','Available')
                ->whereMonth('ca.dateAssigned',$month)
                ->whereYear('ca.dateAssigned',$year)
                ->groupBy('c.caseid')
                ->orderBy('ca.dateAssigned','DESC')
            ->get();
            $cMonth = date("F", mktime(0, 0, 0, $month, 1));
            return view('admin.pendingCrimes',compact('showData', 'cMonth', 'year'));
}
}
  


public function collection() {
        
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
}
